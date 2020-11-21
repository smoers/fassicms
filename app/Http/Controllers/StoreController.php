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
use App\Models\Catalog;
use App\Models\Provider;
use App\Models\Reassortement;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;


/**
 * Class StoreController
 * @package App\Http\Controllers
 */
class StoreController extends Controller
{
    protected $_providers;

    public function __construct()
    {
        $this->_providers = Provider::all()->sortBy('name');
    }

    /**
     * Affiche le formulaire pour introduire une nouvelle pièce
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $store = new Store();
        $catalog = new Catalog();
        $store->enabled = 1;
        $catalog->year = Carbon::now()->year;
        return view('store.store-part-form',
        [
            '_providers' => $this->_providers,
            '_action' => route('store.store'),
            'store' => $store,
            'catalog' => $catalog,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id, $cat_id)
    {
        $store = Store::find($id);
        $catalog = Catalog::find($cat_id);
        return view('store.store-part-form',
            [
                'store' => $store,
                'catalog' => $catalog,
                '_providers' => $this->_providers,
                '_action' => route('store.update')
            ]);
    }

    /**
     * Validation real-time du formulaire
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ajaxValidation(request $request)
    {
        $formRequest = new StorePartRequest();
        $this->validate($request, $formRequest->rules(), $formRequest->messages());

        return response()->json();
    }

    /**
     * @return string
     */
    public function show()
    {
        return 'test';
    }

    /**
     * Sauvegarde un nouvel enregistrement d'une pièce
     * @param Request $request
     */
    public function store(StorePartRequest  $request){

        //Validation
        $validatedData = $request->validated();
        //recherche l'obet Provider
        $provider = Provider::find($validatedData['provider']);
        //hydrate les objets
        $store = new Store();
        $store->fill((array)$validatedData);
        $store->save();
        $catalog = new Catalog();
        $catalog->fill((array) $validatedData);
        $reassort = new Reassortement(); //crée le réassortiment initial
        $reassort->qty_add = $store->qty;
        $reassort->qty_before = 0;
        //relationship
        $catalog->store()->associate($store);
        $catalog->provider()->associate($provider);
        $reassort->store()->associate($store);
        $catalog->save();
        $reassort->save();
        return redirect('store')->with('success','The part number has been saved');
    }

    /**
     * @param StorePartRequest $request
     * @return \Illuminate\Routing\Redirector
     */
    public function update(StorePartRequest $request)
    {
        //charge les objet existants
        $store = Store::find($request->post('id'));
        $catalog = Catalog::find($request->post('cat_id'));
        //les valeurs validées
        $validatedData = $request->validated();
        //mets à jour les objets
        $store->fill((array) $validatedData);
        $catalog->fill((array) $validatedData);
        //sauvergarde
        $store->save();
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
        return view('store.store-list-main');
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
