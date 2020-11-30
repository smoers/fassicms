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
        return redirect('dashboard')->with('success', 'The new customer has been saved');
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
