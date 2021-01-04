<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorksheetRequest;
use App\Moco\Common\Moco;
use App\Moco\Common\MocoAjaxValidation;
use App\Models\Crane;
use App\Models\Customer;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorksheetController extends Controller
{
    use MocoAjaxValidation;
    protected $info_fields = [
        'crane_id' => null,
        'customer_id' => null,
        'serial' => '',
        'model' => '',
        'plate' => '',
        'name' => '',
        'address' => '',
        'phone' => '',
        'email' => '',
        'vat' => '',
    ];

    public function __construct()
    {
        $this->formRequest = new WorksheetRequest();
    }

    public function index()
    {
        return view('worksheet.worksheet-list');
    }

    public function create(Request $request)
    {
        /**
         * Nouvelle objet
         */
        $worksheet = new Worksheet();
        /**
         * Test l'existence d'une session avec la clé worksheet_form
         */
        if ($request->session()->exists('worksheet_form')){
            /**
             * On récupère la valeur des champs info pour le formulaire
             * depuis la variable de session.
             * La variable de session est détruite lors de la récupération
             */
            $worksheet_form = $request->session()->pull('worksheet_form');
            foreach ($this->info_fields as $key => $field){
                if (array_key_exists($key,$worksheet_form))
                    $this->info_fields[$key] = $worksheet_form[$key];
            }

            /**
             * on hydrate l'objet Worksheet avec les valeurs
             * de la variable de session
             */
            $worksheet->number = $worksheet_form['number'];
            $worksheet->date = $worksheet_form['date'];
            $worksheet->remarks = $worksheet_form['remarks'];
            $worksheet->work = $worksheet_form['work'];
            $worksheet->oil_replace = $worksheet_form['oil_replace'];
            $worksheet->oil_filtered = $worksheet_form['oil_filtered'];

        } else {
            /**
             * Pas de variable de session définie
             * Place les valeur par défaut
             */
            $worksheet->number = Moco::worksheetNumber();
            $worksheet->date = Carbon::now('Europe/Brussels')->format('d/m/Y');
            $worksheet->oil_filtered = false;
        }
        $worksheet->crane()->associate(new Crane());
        $worksheet->customer()->associate(new Customer());
        return view('worksheet.worksheet-form',[
                '_action' => route('worksheet.store'),
                'worksheet' => $worksheet,
                'info_fields' => $this->info_fields,
            ]);
    }

    public function store(WorksheetRequest $request)
    {
        /**
         * Récupère les données validées
         */
        $validatedData = $request->validated();

        /**
         * Recherche les objects liés
         */
        $crane = Crane::find($validatedData['crane_id']);
        $customer = Customer::find($validatedData['customer_id']);

        /**
         * Hydrate le nouvel object worksheet
         */
        $worksheet = new Worksheet();
        $worksheet->number = $validatedData['number'];
        $worksheet->date = $validatedData['date'];
        $worksheet->remarks = $validatedData['remarks'];
        $worksheet->work = $validatedData['work'];
        $worksheet->oil_replace = $validatedData['oil_replace'];
        $worksheet->oil_filtered = $validatedData['oil_filtered'];
        $worksheet->customer()->associate($customer);
        $worksheet->crane()->associate($crane);

        /**
         * sauvegarde l'objet
         */
        $worksheet->save();

        /**
         * redirection
         */
        return redirect()->route('dashboard')->with('success','The worksheet has been saved ');
    }

    public function edit($id)
    {
        return view('worksheet.worksheet-form',[
            'action' => route('worksheet.update',$id),
            'title' => trans('Modify worksheet'),
            'worksheet' => Worksheet::find($id),
        ]);
    }

    /**
     * Retourne un Json des objets
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSelect(Request $request)
    {
        $return = null;
        if ($request->post('whatIs') == 'customer'){
            $return = Customer::where('name','like','%'.$request->post('name').'%' )->orderBy('name')->get();
        } elseif ($request->post('whatIs') == 'crane'){
            $return = Crane::where('serial','like','%'.$request->post('serial').'%')->orderBy('serial')->get();
        }
        return response()->json($return);
    }

    public function addOption(Request $request)
    {
        $request->session()->put('worksheet_form',$request->all());
        $route = route('dashboard');
        if ($request->post('whatIs') == 'add_customer'){
            $route = route('customer.create');
        } elseif ($request->post('whatIs') == 'add_crane'){
            $route = route('crane.create');
        }
        return redirect($route);
    }
}
