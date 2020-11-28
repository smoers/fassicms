<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Moco\Common\MocoAjaxValidation;
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
        $this->formRequest = new CustomerRequest();
    }


    public function create()
    {
        return view('customer.customer-form');
    }

    public function store(Request $request)
    {

    }

    public function ajaxSelect(Request $request)
    {
        $zipcodes = Zipcode::where('zipcode','like',$request->post('zipcode').'%');

    }




}
