<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Moco\Common\MocoAjaxValidation;
use App\Models\Customer;
use App\Models\Zipcode;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('customer.customer-form');
    }


    public function store(CustomerRequest $request)
    {
        $validateData = $request->validated();
        $customer = new Customer();
        $customer->fill($validateData);
        $customer->save();
        /**
         * récupère la route par défaut
         */
        $route = route('dashboard');
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
            $route = route('worksheet.create');
        }
        return redirect($route)->with('success', 'The new customer has been saved');
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
}
