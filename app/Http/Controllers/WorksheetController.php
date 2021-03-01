<?php
/*
 * Copyright (c) 2021. MO Consult
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 *
 *  Company : Fassi Belgium
 *  Developer : MO Consult
 *  Author : Moers Serge
 *  Date : 4/01/21 17:59
 */

namespace App\Http\Controllers;

use App\Http\Requests\WorksheetRequest;
use App\Moco\Common\Moco;
use App\Moco\Common\MocoAjaxValidation;
use App\Moco\Common\MocoArrayFieldsValues;
use App\Moco\Common\MocoOptions;
use App\Moco\Common\MocoOptionsListWorksheetPrint;
use App\Moco\Printer\MocoPrintTemplate;
use App\Moco\Printer\MocoWorksheet;
use App\Models\Crane;
use App\Models\Customer;
use App\Models\Technician;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorksheetController extends Controller
{
    use MocoAjaxValidation;
    use MocoArrayFieldsValues;

    protected $info_fields = [
        'crane_id' => null,
        'customer_id' => null,
        'serial' => '',
        'model' => '',
        'plate' => '',
        'name' => '',
        'address' => '',
        'phone' => '',
        'mail' => '',
        'vat' => '',
    ];

    /**
     * WorksheetController constructor.
     */
    public function __construct()
    {
        $this->formRequest = new WorksheetRequest();
    }

    /**
     * Permet de lister les fiches de travail
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('worksheet.worksheet-list');
    }

    /**
     * Création d'une nouvelle fiche de travail
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        /**
         * Nouvelle objet
         */
        $worksheet = new Worksheet();
        /**
         * Défini la source dans une variable de session
         */
        $request->session()->put('worksheet_source',route('worksheet.create'));
        /**
         * Test l'existence d'une session avec la clé worksheet_form
         */
        if ($request->session()->exists('worksheet_form')){
            /**
             * On hydrate l'objet et le table
             */
            $this->hydrateWorksheetForm(
                /**
                 * On récupère la valeur des champs info pour le formulaire
                 * depuis la variable de session.
                 * La variable de session est détruite lors de la récupération
                 */
                $request->session()->pull('worksheet_form'),
                $worksheet
            );

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
                'action' => route('worksheet.store'),
                'worksheet' => $worksheet,
                'info_fields' => $this->info_fields,
                'title' =>trans('Add a worksheet'),
            ]);
    }

    /**
     * Sauvegarde la nouvelle fiche de travail
     *
     * @param WorksheetRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
        $worksheet->fill($validatedData);
        $worksheet->customer()->associate($customer);
        $worksheet->crane()->associate($crane);
        $worksheet->user()->associate(Auth::user());

        /**
         * sauvegarde l'objet
         */
        $worksheet->save();

        /**
         * redirection
         */
        return redirect()->route('dashboard')->with('success','The worksheet has been saved ');
    }

    /**
     * Permet de modifier une fiche de travail existante
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, $id)
    {
        /**
         * Défini la source dans une variable de session
         */
        $request->session()->put('worksheet_source',route('worksheet.edit',['id'=>$id]));
        /**
         * Récupère les objets
         */
        $worksheet = Worksheet::find($id);
        $crane = Crane::find($worksheet->crane()->get('id'))->first();
        $customer = Customer::find($worksheet->customer()->get('id'))->first();
        /**
         * Test l'existence d'une session avec la clé worksheet_form
         */
        if ($request->session()->exists('worksheet_form')) {
            /**
             * On hydrate l'objet et le table
             */
            $this->hydrateWorksheetForm(
                /**
                 * On récupère la valeur des champs info pour le formulaire
                 * depuis la variable de session.
                 * La variable de session est détruite lors de la récupération
                 */
                $request->session()->pull('worksheet_form'),
                $worksheet
            );

        } else {
            /**
             * on charge le tableau
             */
            $this->info_fields = $this->arrayFieldsValues($this->info_fields,$customer,['id' => 'customer_id']);
            $this->info_fields = $this->arrayFieldsValues($this->info_fields,$crane,['id' => 'crane_id' ]);

        }
        return view('worksheet.worksheet-form',[
            'action' => route('worksheet.update',$id),
            'title' => trans('Modify a worksheet'),
            'worksheet' => $worksheet,
            'info_fields' => $this->info_fields,
        ]);
    }

    public function update(WorksheetRequest $request, $id)
    {
        /**
         * Recherche l'objet à modifier
         */
        $worksheet = Worksheet::find($id);

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
        $worksheet->fill($validatedData);
        $worksheet->customer()->associate($customer);
        $worksheet->crane()->associate($crane);
        $worksheet->user()->associate(Auth::user());

        /**
         * sauvegarde l'objet
         */
        $worksheet->save();

        /**
         * redirection
         */
        return redirect()->route('worksheet.index')->with('success','The worksheet has been saved ');

    }

    public function show($id)
    {
        $worksheet = Worksheet::find($id);
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

    /**
     * Ceci permet d'ouvrir le formulaire pour ajouter une nouvelle grue
     * ou un nouveau client tout en conservant les valeurs déjà introduite.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * Permet l'impression d'une fiche de travail
     *
     * @param Request $request
     */
    public function print(Request $request)
    {
        $worksheet = Worksheet::find($request->post('id'));
        $options = new MocoOptions(new MocoOptionsListWorksheetPrint());
        $options->manualHours = $request->post('mh');
        $options->hours = $request->post('h');
        $options->parts = $request->post('p');
        $pdf = new MocoWorksheet($worksheet, $options);
        $pdf->build();
        $pdf->Output();

    }

    /**
     * Création de la liste des champs info avec la valeur
     * contenue dans le tableau
     *
     * @param array $worksheet_form
     * @param Worksheet $worksheet
     * @return Worksheet
     */
    private function hydrateWorksheetForm(array $worksheet_form, Worksheet $worksheet): Worksheet
    {
        /**
         * On récupère la valeur des champs info pour le formulaire
         * depuis la variable de session.
         * La variable de session est détruite lors de la récupération
         */
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

        return $worksheet;
    }
}
