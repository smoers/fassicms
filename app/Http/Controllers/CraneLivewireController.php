<?php

namespace App\Http\Controllers;

use App\Http\Requests\CraneRequest;
use App\Models\TrucksCrane;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Livewire\Component;

class CraneLivewireController extends Component
{
    /**
     * Numéro de série de la grue
     * @var string
     */
    public string $serial = '';
    /**
     * Modele de la grue
     * @var string
     */
    public string $crane_model;
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
    public $truck_model;
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
     *
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
            'histories' => $this->getHistory(),
        ]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly(
            $propertyName,
            $this->formRequest->rules(),
            $this->formRequest->messages(),
            $this->formRequest->attributes()
        );
    }

    public function save()
    {
        $validatedData = $this->validate();
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
                $this->crane_model = $crane->crane_model;
                if ($this->plate === '') {
                    /**
                     * pas de camion défini
                     */
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
                $this->brand = $truck->brand;
                $this->truck_model = $truck->truck_model;
                if ($this->serial === '')
                    /**
                     * pas de grue définie
                     */
                    $this->crane_model = $truck->crane_model;
            } elseif ($previousPlate !== $this->plate) {
                /**
                 * Si la valeur de Plate a été modifiée par rapport à la session précédante
                 * et n'est pas connue dans la table
                 */
                $this->brand = '';
                $this->truck_model = '';
            }
        }
        /**
         * stoque les variables Serial et Plate
         */
        $request->session()->put('serial',$this->serial);
        $request->session()->put('plate',$this->plate);
        /**
         * Sur base de la valeurs des champs on détermine le mode
         */
        $this->getRecordMode();
    }

    /**
     * Récupère l'historique de la grue et du camion afin de les lister
     *
     * @return array[]
     */
    protected function getHistory(): array
    {
        $history = [
            'crane' => [],
            'truck' => [],
        ];
        switch ($this->mode['value']){
            case 4:
            case 1:
                $history['crane'] = $this->getCraneHistory();
                break;
            case 2:
                $history['crane'] = $this->getCraneHistory();
                $history['truck'] = $this->getTruckHistory();
                break;
            case 3:
                $history['truck'] = $this->getTruckHistory();
                break;
        }
        $this->hasHistoric = $history['crane'] != [] || $history['truck'] != [];
        return $history;
    }

    /**
     * Query pour récupérer l'historique d'une grue
     *
     * @return array
     */
    protected function getCraneHistory()
    {
        if (!is_null($crane = TrucksCrane::leftjoin('customers', 'customers.id', '=', 'trucks_cranes.customer_id')->where('serial', $this->serial)->orderBy('date_current', 'desc')->get())) {
            return $crane;
        }
        return [];
    }

    /**
     * Query pour récupérer l'historique d'un camion
     *
     * @return array
     */
    protected function getTruckHistory()
    {
        if (!is_null($truck = TrucksCrane::leftjoin('customers','customers.id','=','trucks_cranes.customer_id')->where('plate',$this->plate)->orderBy('date_current','desc')->get())) {
            return $truck;
        }
        return [];
    }

    /**
     * Détermine le mode d'intervention modification ou nouveau
     */
    public function getRecordMode(): void
    {
        $crane = $this->getCrane();
        $truck = $this->getTruck();

        $this->mode = ['value' => 0, 'msg' => null];
        if (!is_null($crane) && !is_null($truck) && $crane->id === $truck->id){
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
        } elseif (is_null($crane) && is_null($truck) && ($this->serial != '' || $this->plate != '') ){
            $this->mode['value'] = 5;
            $this->mode['msg'] = trans('New crane and truck');
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
        else
            return null;
    }

}
