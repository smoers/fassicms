<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Moco\Common\MocoAjaxValidation;
use App\Moco\Common\MocoModelForConsult;
use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\Zipcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;

class CustomerController extends Controller
{
    use MocoAjaxValidation;

    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        //nécessaire pour le trait de validation
        $this->formRequest = new CustomerRequest();
    }

    public function index(){
        return view('customer.customer-list');
    }

    /**
     * Chargement du formulaire permettant la création d'un nouveau client
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $customer = new Customer();
        $customer->black_listed = 0;
        return view('customer.customer-form',
            [
                'action' => route('customer.store'),
                'customer' => $customer,
                'title' => trans('Add customer'),
            ]);
    }

    /**
     * Chargement du formulaire permettant la modification d'un client existant
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        return view('customer.customer-form',
            [
                'action' => route('customer.update', $id),
                'customer' => $customer = Customer::find($id),
                'title' => trans('Modify customer'),
                '_zipcode' => Zipcode::where('zipcode','=',$customer->zipcode)->first(),
            ]
        );
    }

    /**
     * Mise à jour de l'enregistrement
     *
     * @param CustomerRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerRequest $request, $id)
    {
        /**
         * Obtenir les valeurs validées
         */
        $validatedData = $request->validated();
        /**
         * Sauvegarde les modifications de l'objet Customer
         */
        $customer = Customer::find($id);
        $customer->fill($validatedData);
        $customer->user()->associate(Auth::user());
        /**
         * Y a t il des contacts
         */
        $contacts = [];
        if(array_key_exists('contacts',$validatedData))
            $contacts = $validatedData['contacts'];

        DB::transaction(function ()  use($customer,$contacts) {
            $customer->save();
            /**
             * Supprime les contacts qui ne font plus partie de la liste POST
             */
            CustomerContact::remove($contacts,$customer);
            /**
             * Sauvegarde les contacts qui sont dans le liste POST
             * Si il y en a !!
             */
            if (!empty($contacts))
                CustomerContact::hydratedAndSave($contacts,$customer);
        });
        return redirect()->route('customer.index')->with('success',trans('The customer has been modified with success'));

    }

    /**
     * Sauvegarde un nouveau client
     *
     * @param CustomerRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CustomerRequest $request)
    {
        $validateData = $request->validated();
        /**
         * Liste des contacts à sauvegarder
         */
        $contacts = $validateData['contacts'];
        /**
         * Création de l'objet Customer
         */
        $customer = new Customer();
        $customer->fill($validateData);
        $customer->user()->associate(Auth::user());
        /**
         * Sauvegarde
         */
        DB::transaction(function () use($customer,$contacts){
            $customer->save();
            /**
             * Sauvegarde les contacts qui sont dans le liste POST
             */
            CustomerContact::hydratedAndSave($contacts,$customer);
        });

        /**
         * récupère la route par défaut
         */
        $route = route('customer.index');
        /**
         * On controle si la demande d'ajout a été faite depuis le formulaire d'ajout d'une fiche de travail
         */
        if ($request->session()->exists('worksheet_form')){
            $worksheet_form = $request->session()->get('worksheet_form');
            $worksheet_form['customer_id'] = $customer->id;
            $worksheet_form['name'] = $customer->name;
            $worksheet_form['address'] = $customer->address.', '.$customer->zipcode.', '.$customer->city;
            $worksheet_form['email'] = $customer->mail;
            $worksheet_form['phone'] = $customer->phone;
            $worksheet_form['vat'] = $customer->vat;
            $request->session()->put('worksheet_form',$worksheet_form);
            $route = $request->session()->get('worksheet_source');
        }
        return redirect($route)->with('success', trans('The new customer has been saved'));
    }

    /**
     * Répond au requête Ajax du select element
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSelect(Request $request)
    {
        $zipcodes = Zipcode::where('zipcode','like',$request->post('zipcode').'%')->get();
        return response()->json($zipcodes);
    }

    /**
     * Permet l'affichage des données en mode consultation
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        if (!is_null($customer)){
            $mocoModelForConsult = new MocoModelForConsult($customer,Auth::user()->can('consult customer extended'));
            return view('consult.consult',
                [
                    'title' => trans('Consult Customer'),
                    'consult' => $mocoModelForConsult->getBladeLayout(),
                    'return' => route('customer.index'),
                ]);
        }
        return redirect()->route('customer.index');
    }
}
