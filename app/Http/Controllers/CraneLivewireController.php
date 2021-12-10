<?php

namespace App\Http\Controllers;

use App\Http\Requests\CraneRequest;
use App\Moco\Common\TruckCraneHistory;
use App\Models\Customer;
use App\Models\TrucksCrane;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CraneLivewireController extends Component
{
    /**
     * identifiant depios une recherche d'unr grue
     * @var
     */
    public $crane_id;
    /**
     * identifiant depuis une recherche d'un camion
     * @var
     */
    public $truck_id;
    /**
     * Numéro de série de la grue
     * @var string
     */
    public string $serial = '';
    /**
     * Modele de la grue
     * @var string
     */
    public string $crane_model = '';
    /**
     * Numéro de plaque du camion
     * @var string
     */
    public string $plate = '';
    /**
     * Marque du camion
     * @var
     */
    public $brand;
    /**
     * Modèle du camion
     * @var
     */
    public $truck_model = '';
    /**
     * identifiant du client
     * @var
     */
    public $customer_id = '';
    /**
     * Nom du client
     * @var string
     */
    public $customer_name = '';

    /**
     * Mode d'action sur l'enregistrement
     * @var array
     */
    public $mode = ['value' => 0, 'msg' => null];
    /**
     * Y a t il un historique de disponible
     * @var bool
     */
    public $hasHistoric = false;
    /**
     * form request pour la validation des champs
     * @var
     */
    protected $formRequest;
    /**
     * Message lors de la sauvegarde
     * @var string
     */
    protected string $saveMessage = '';
    /**
     * Définition des listeners
     * @var string[]
     */
    protected $listeners = [
        'eventCustomerNameFocusOut' => 'eventCustomerNameFocusOut',
        'save' => 'save'
        ];

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->formRequest = new CraneRequest();
    }

    /**
     * Utilisé pour initialiser
     */
    public function mount()
    {
        session()->remove('serial');
        session()->remove('plate');
        session()->remove('customer_name');
    }

    /**
     * retourne la vue
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render(Request $request)
    {
        $this->init($request);

        return view('crane.crane-livewire',[
            'listCranes' => $this->getListCranes(),
            'listTrucks' => $this->getListTrucks(),
            'listCustomers' => $this->cleanupCustomerInput(),
            'histories' => $this->getHistory(),
            'message' => $this->saveMessage,
        ]);
    }

    /**
     * Validation en temps réél
     *
     * @param $propertyName
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly(
            $propertyName,
            $this->formRequest->rules(),
            $this->formRequest->messages(),
            $this->formRequest->attributes()
        );
    }

    /**
     * On valide mle contenu des champs et on ouvre le message d'avertissement
     */
    public function validated()
    {
        /**
         * Validation
         */
        $validatedData = $this->validate(
            $this->formRequest->rules(),
            $this->formRequest->messages(),
            $this->formRequest->attributes()
        );
        /**
         * détermine le mode
         */
        $this->getRecordMode();
        /**
         * sélection du message
         */
        $modal = true;
        switch ($this->mode['value']) {
            case 5:
            case 1:
                $this->save();
                $modal = false;
                break;
            case 2:
                $this->saveMessage = trans('You will create a new record with an existing crane and truck.</br>So crane and truck here below will be flagged as obsolete to keep a historical of each crane.</br>');
                $this->saveMessage .= trans('Crane : ') . $validatedData['serial'] . '</br>' . trans('Truck : ') . $validatedData['plate'];
                break;
            case 3:
                $this->saveMessage = trans('You will assign a new crane to an existing truck.</br>So truck here below will be flagged as obsolete to keep a historical of each crane.</br>');
                $this->saveMessage .= trans('Truck : ') . $validatedData['plate'];
                break;
            case 4:
                $this->saveMessage = trans('You will assign a new truck to an existing crane.</br>So crane here below will be flagged as obsolete to keep a historical of each crane.</br>');
                $this->saveMessage .= trans('Crane : ') . $validatedData['serial'];
                break;
            case 6:
                $this->saveMessage = trans('You will move the crane and truck to another customer.</br>So crane and truck here below will be flagged as obsolete to keep a historical of each crane.</br>');
                $this->saveMessage .= trans('Crane : ') . $validatedData['serial'] . '</br>' . trans('Truck : ') . $validatedData['plate'];
                break;
        }
        /**
         * Ouverture du message en modal
         */
        if ($modal)
            $this->openModal();
    }

    /**
     * On va sauvegarder les données
     */
    public function save()
    {
        /**
         * Validation
         */
        $validatedData = $this->validate(
            $this->formRequest->rules(),
            $this->formRequest->messages(),
            $this->formRequest->attributes()
        );
        /**
         * détermine le mode
         */
        $this->getRecordMode();
        /**
         *
         */
        $truckCrane = null;
        $crane = null;
        $truck = null;
        switch ($this->mode['value']){
            /**
             * modification
             */
            case 1:
                /**
                 * qui dispose de l'ID du record
                 */
                $id = is_null($validatedData['crane_id']) ? $validatedData['truck_id'] : $validatedData['crane_id'];
                /**
                 * recherche le record
                 */
                $truckCrane = TrucksCrane::find($id);
                /**
                 * Charge les données
                 */
                $truckCrane->crane_model = $validatedData['crane_model'];
                $truckCrane->brand = $validatedData['brand'];
                $truckCrane->truck_model = $validatedData['truck_model'];
                break;
            /**
             * nouveau avec une grue et camion existant
             */
            case 2:
                /**
                 * place les propriétés Current
                 */
                $crane = $this->setCurrent($validatedData['crane_id']);
                $truck = $this->setCurrent($validatedData['truck_id']);
                /**
                 * Nouveau record
                 */
                $truckCrane = $this->fillNewModel($validatedData);
                break;
            /**
             * nouvelle grue, camion existant
             */
            case 3:
                /**
                 * place les propriétés Current
                 */
                $truck = $this->setCurrent($validatedData['truck_id']);
                /**
                 * Nouveau record
                 */
                $truckCrane = $this->fillNewModel($validatedData);
                break;
            /**
             * nouveau camion, grue existante
             */
            case 4:
                /**
                 * place les propriétés Current
                 */
                $crane = $this->setCurrent($validatedData['crane_id']);
                /**
                 * Nouveau record
                 */
                $truckCrane = $this->fillNewModel($validatedData);
                break;
            /**
             * nouvelle grue et nouveau camion
             */
            case 5:
                $truckCrane = $this->fillNewModel($validatedData);
                break;
            /**
             * changement de client
             */
            case 6:
                /**
                 * qui dispose de l'ID du record
                 */
                $id = is_null($validatedData['crane_id']) ? $validatedData['truck_id'] : $validatedData['crane_id'];
                /**
                 * place les propriétés Current
                 */
                $crane = $this->setCurrent($id);
                /**
                 * Nouveau record
                 */
                $truckCrane = $this->fillNewModel($validatedData);
                break;

        }
        /**
         * Sauvegarde des données
         */
        $exception = DB::transaction(function () use ($truckCrane, $crane, $truck){
            if (!is_null($crane))
                $crane->save();
            if (!is_null($truck))
                $truck->save();
            $truckCrane->save();
        });
        /**
         * message de retour
         */
        if (is_null($exception)){
            session()->flash('success',trans('The data have been saved with success'));
            return redirect()->route('crane.index');
        } else {
            session()->flash('error',trans('There is a structure issue in the table.  Please contact your administrator'));
            return redirect()->route('crane.index');
        }

    }

    /**
     * Rempli un nouvel enregistrement
     *
     * @param $validatedData
     * @return TrucksCrane|null
     */
    protected function fillNewModel($validatedData): ?TrucksCrane
    {
        /**
         * recherche le record pour le client
         */
        $customer = Customer::find($validatedData['customer_id']);
        /**
         * Nouveau record
         */
        $truckCrane = new TrucksCrane();
        $truckCrane->current =  true;
        $truckCrane->serial = $validatedData['serial'];
        $truckCrane->crane_model = $validatedData['crane_model'];
        $truckCrane->plate = $validatedData['plate'];
        $truckCrane->brand = $validatedData['brand'];
        $truckCrane->truck_model = $validatedData['truck_model'];
        $truckCrane->user()->associate(Auth::user());
        $truckCrane->customer()->associate($customer);

        return $truckCrane;
    }

    /**
     * on placce l'enregistrement comme inactif
     *
     * @param $id
     * @param false $current
     * @return TrucksCrane|null
     */
    protected function setCurrent($id, bool $current = false): ?TrucksCrane
    {
        $truckCrane = TrucksCrane::find($id);
        $truckCrane->current = $current;
        $truckCrane->date_current = Carbon::now()->format('d/m/Y');
        return $truckCrane;
    }

    /**
     * Initialise les données avant de retourner la vue
     *
     * @param Request $request
     */
    public function init(Request $request): void
    {
        $this->setFieldsValue($request);
    }

    /**
     * Retourne le tableau avec la liste filtrée des grues
     *
     * @return array|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    protected function getListCranes()
    {
        return $this->serial === '' ? [] : TrucksCrane::query()->where('current','=',true)->where('serial','like','%'.$this->serial.'%')->orderBy('serial')->get();
    }

    /**
     * Retourne l'enregistrement sur base d'un serial
     *
     * @return Model|null
     */
    protected function getCrane(): ?Model
    {
        return TrucksCrane::where('current','=',true)->where('serial',$this->serial)->first();
    }

    /**
     * Retourne le tableau avec la liste filtrée des camions
     *
     * @return array|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    protected function getListTrucks()
    {
        return $this->plate === '' ? [] : TrucksCrane::query()->where('current','=',true)->where('plate','like','%'.$this->plate.'%')->orderBy('plate')->get();
    }

    /**
     * Retourne l'enregistrement sur base d'une plate
     *
     * @return Model|null
     */
    protected function getTruck(): ?Model
    {
        return TrucksCrane::where('current','=',true)->where('plate',$this->plate)->first();
    }

    /**
     * Retourne le tableau avec la liste filtrée des clients
     *
     * @return array|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    protected function getListCustomers()
    {
        return $this->customer_name === '' ? [] : Customer::query()->where('black_listed','=', false)->where('name','like','%'.$this->customer_name.'%')->orderBy('name')->get();
    }

    /**
     * Retourne l'enregistrement sur base d'un nom du client
     *
     * @return Model|null
     */
    protected function getCustomer($byID = false): ?Model
    {
        if ($byID)
            return Customer::find($this->customer_id);
        else
            return Customer::where('black_listed','=', false)->where('name','=',$this->customer_name)->first();
    }

    /**
     * Va placer les valeurs des autres champs
     * sur base du champ qui a été modifié
     *
     * @param Request $request
     */
    protected function setFieldsValue(Request $request)
    {

        /**
         * Valeur précédente du champ Serial et du champ Plate
         */
        $previousSerial = $request->session()->get('serial', null);
        $previousPlate = $request->session()->get('plate',null);
        $previousCustomer_name = $request->session()->get('customer_name',null);
        if ($this->getLastChangedField() === 'serial') {
            /**
             * action sur le champ Serial
             */
            if ($this->serial !== '' && $previousSerial !== $this->serial && !is_null($crane = $this->getCrane())) {
                /**
                 * Si la valeur du serial n'est pas vide
                 * Que l'on aie un serial différent du précédent
                 * Et que celui-ci existe dans la table
                 */
                $this->crane_id = $crane->id;
                $this->crane_model = $crane->crane_model;
                $this->customer_id = $crane->customer_id;
                $this->customer_name = $this->getCustomer(true)->name;
                if ($this->plate === '') {

                    /**
                     * pas de camion défini
                     */
                    $this->truck_id = $crane->id;
                    $this->plate = $crane->plate;
                    $this->brand = $crane->brand;
                    $this->truck_model = $crane->truck_model;
                }
            } elseif ($previousSerial !== $this->serial) {
                /**
                 * Si la valeur du Serial a été modifiée par rapport à la session précédante
                 * et n'est pas connue dans la table
                 */
                $this->crane_model = '';
                $this->crane_id = null;
            }
        } elseif ($this->getLastChangedField() === 'plate') {
            /**
             * action sur le champ Plate
             */
            if ($this->plate !== '' && $previousPlate !== $this->plate && !is_null($truck = $this->getTruck())) {
                /**
                 * Si la valeur du plate n'est pas vide
                 * Que l'on aie un plate différent du précédent
                 * Et que celui-ci existe dans la table
                 */
                $this->truck_id = $truck->id;
                $this->brand = $truck->brand;
                $this->truck_model = $truck->truck_model;
                $this->customer_id = $truck->customer_id;
                $this->customer_name = $this->getCustomer(true)->name;
                if ($this->serial === '') {
                    /**
                     * pas de grue définie
                     */
                    $this->crane_id = $truck->id;
                    $this->serial = $truck->serial;
                    $this->crane_model = $truck->crane_model;
                }
            } elseif ($previousPlate !== $this->plate) {
                /**
                 * Si la valeur de Plate a été modifiée par rapport à la session précédante
                 * et n'est pas connue dans la table
                 */
                $this->brand = '';
                $this->truck_model = '';
                $this->truck_id = null;
            }
        } elseif ($this->getLastChangedField() === 'customer_name'){
            if($this->customer_name !== '' && $previousCustomer_name !== $this->customer_name && !is_null($customer = $this->getCustomer())){
                $this->customer_id = $customer->id;
            }
        }
        /**
         * stoque les variables Serial, Plate & Customer Name
         */
        $request->session()->put('serial',$this->serial);
        $request->session()->put('plate',$this->plate);
        $request->session()->put('customer_name', $this->customer_name);
        /**
         * Sur base de la valeurs des champs on détermine le mode
         */
        $this->getRecordMode();
    }

    /**
     * Récupère l'historique de la grue et du camion afin de les lister
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    protected function getHistory()
    {
        $truckCraneHistory = new TruckCraneHistory($this->serial,$this->plate);
        $history = $truckCraneHistory->getHistory();
        $this->hasHistoric = $history->count() != 0;
        return $history;
    }

    /**
     * Détermine le mode d'intervention modification ou nouveau
     */
    public function getRecordMode(): void
    {
        $crane = $this->getCrane();
        $truck = $this->getTruck();
        $customer = $this->getCustomer();
        $truck_crane = $crane; //juste pour simplifier la compréhension des conditions ci-dessous

        $this->mode = ['value' => 0, 'msg' => null];
        if (!is_null($crane) && !is_null($truck) && !is_null($customer) && $crane->id === $truck->id && $truck_crane->customer_id === $customer->id){
            $this->mode['value'] = 1;
            $this->mode['msg'] = trans('Modify');
        } elseif (!is_null($crane) && !is_null($truck) && $crane->id !== $truck->id) {
            $this->mode['value'] = 2;
            $this->mode['msg'] = trans('New with existing items');
        } elseif (is_null($crane) && !is_null($truck)){
            $this->mode['value'] = 3;
            $this->mode['msg'] = trans('New crane with existing truck');
        } elseif (!is_null($crane) && is_null($truck)){
            $this->mode['value'] = 4;
            $this->mode['msg'] = trans('New truck with existing crane');
        } elseif (is_null($crane) && is_null($truck) && ($this->serial != '' || $this->plate != '' || $this->customer_name != '' || $this->crane_model != '') ){
            $this->mode['value'] = 5;
            $this->mode['msg'] = trans('New crane and truck');
        } elseif (!is_null($crane) && !is_null($truck) && !is_null($customer) && $crane->id === $truck->id && $truck_crane->customer_id !== $customer->id) {
            $this->mode['value'] = 6;
            $this->mode['msg'] = trans('Existing crane and truck to different customer');
        }

    }

    /**
     * Permet de savoir lequel des deux champs a été modifié.
     *
     * @return string|null
     */
    protected function getLastChangedField(): ?string
    {
        if (session()->get('serial','') != $this->serial)
            return 'serial';
        elseif (session()->get('plate','') != $this->plate)
            return 'plate';
        elseif (session()->get('customer_name') != $this->customer_name)
            return 'customer_name';
        else
            return null;
    }

    /**
     * Perrmet de limiter les valeurs du champ aux valeurs de la table
     * Impossible d'introduire une valeur aléatoire
     *
     * @return array|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    protected function cleanupCustomerInput()
    {
        $listCustomers = $this->getListCustomers();
        if ($this->customer_name !== '' && count($listCustomers) === 0){
            $this->customer_name = '';
        }
        return $listCustomers;
    }

    public function eventCustomerNameFocusOut()
    {
        if (is_null($this->getCustomer()))
            $this->customer_name = '';
    }

    public function openModal()
    {
        $this->dispatchBrowserEvent('openMessageModal',['message' => $this->saveMessage] );
    }

}
