<?php
/*
 * Copyright (c) 2020. MO Consult
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
 *  Date : 11/11/20 11:53
 */

namespace App\Http\Controllers;

use App\Http\Requests\StorePartRequest;
use App\Moco\Common\OptionsView;
use App\Models\Catalog;
use App\Models\Provider;
use App\Models\Store;
use Illuminate\Http\Request;


class StoreController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Options d'affichage
        /*
        $options = new OptionsView();
        $options->setName('form01');
        $options->setContainer('container');
        */
        $_providers = Provider::all()->sortBy('name');
        $_enabled = 1;

        return view('store.store-part-form',
        [
            '_providers' => $_providers,
            '_enabled' => $_enabled
        ]);
        //return view('layouts.store-layout')->with('options', $options);
    }


    public function ajaxValidation(request $request)
    {
        $formRequest = new StorePartRequest();
        $this->validate($request, $formRequest->rules(), $formRequest->messages());
        return response()->json();
    }

    public function show()
    {
        return 'test';
    }

    /**
     * @param Request $request
     */
    public function store(StorePartRequest  $request){

        //Validation
        $validatedData = $request->validated();
        //recherche l'obet Provider
        $provider = Provider::find($validatedData['provider']);
        //Sauve objet Store
        $store = new Store();
        $store->fill((array)$validatedData);
        $store->save();
        //Sauve objet Catalog
        $catalog = new Catalog();
        $catalog->fill((array) $validatedData);
        $catalog->store()->associate($store);
        $catalog->provider()->associate($provider);
        $catalog->save();
        return redirect('store')->with('success','The part number has been saved');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Options d'affichage
        $options = new OptionsView();
        $options->setName('list01');
        $options->setContainer('container-fluid');

        return view('layouts.store-layout')->with('options',$options);
    }

    public function barcodeSticker(Request $request)
    {
        $pdf = new \TCPDF();
        $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM); // Whether to enable automatic paging
        $pdf->setPrintHeader(false);
        $pdf->addPage();
        $pdf->setFont('helvetica','',6);
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false, // border
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => false, // whether to display the text below the barcode
            'font' => 'helvetica', //font
            'fontsize' => 6, //font size
            'stretchtext' => 6
        );
        $pdf->Text(50,20,"MOERS Serge");
        $pdf->ln();
        $pdf->write1DBarcode("M-14876%()",'C39E','','','',18,0.4,$style,'N');
        $pdf->Output('test.pdf');
    }
}
