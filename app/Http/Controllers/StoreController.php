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

use App\Http\Requests\PartmetadataUpdateRequest;
use App\Http\Requests\StorePartRequest;
use App\Moco\Common\MocoAjaxValidation;
use App\Moco\Common\MocoModelForConsult;
use App\Moco\Printer\MocoSticker;
use App\Moco\Printer\MocoStickerModel;
use App\Models\Catalog;
use App\Models\Location;
use App\Models\Partmetadata;
use App\Models\Provider;
use App\Models\Reason;
use App\Models\Reassortement;
use App\Models\Store;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * Class StoreController
 * @package App\Http\Controllers
 */
class StoreController extends Controller
{
    use MocoAjaxValidation;
    protected $_providers;
    protected $newId;

    public function __construct()
    {
        $this->formRequest = new StorePartRequest();
        $this->_providers = Provider::all()->sortBy('name');
        $this->newId = config('moco.reason.newId');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('store.store-list-main');
    }

    /**
     * Affiche le formulaire pour introduire une nouvelle pièce
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $partmetadata = new Partmetadata();
        $catalog = new Catalog();
        $store = new Store();
        $partmetadata->enabled = 1;
        $catalog->year = Carbon::now()->year;
        return view('store.store-part-form',
        [
            'title' => trans('Add a part'),
            '_providers' => $this->_providers,
            'partmetadata' => $partmetadata,
            'store' => $store,
            'catalog' => $catalog,
            '_action' => route('store.store'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param $cat_id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $id, $cat_id)
    {
        $partmetadata = Partmetadata::find($id);
        $catalog = Catalog::find($cat_id);
        return view('store.store-part-form',
            [
                'title' => trans('Edit a part'),
                'partmetadata' => $partmetadata,
                'catalog' => $catalog,
                '_providers' => $this->_providers,
                '_action' => route('store.update'),
            ]);
    }

    /**
     * @return string
     */
    public function show(Request $request)
    {
        $partmetadata = Partmetadata::find($request->id);
        if (!is_null($partmetadata)){
            /**
             * Charge les modèles des relations
             */
            $partmetadata->loadForConsult();
            $mocoModelForConsult = new MocoModelForConsult($partmetadata);
            //dd($mocoModelForConsult->getBladeLayout());
            return view('consult.consult',
                [
                    'title' => trans('Consult Catalog'),
                    'consult' => $mocoModelForConsult->getBladeLayout(),
                ]);
        }

        return redirect()->route('store.index');

    }

    /**
     * Sauvegarde un nouvel enregistrement d'une pièce
     *
     * @param StorePartRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePartRequest $request){

        /**
         * Validation
         */
        $validatedData = $request->validated();
        /**
         * recherche l'objet Provider
         */
        $provider = Provider::find($validatedData['provider']);
        /**
         * recherche l'objet reason
         */
        $reason = Reason::find($this->newId);
        /**
         * Recherche l'objet Location
         */
        $location = Location::find($validatedData['location_id']);
        /**
         * hydrate l'objet Partmetadata
         */
        $partmetadata = new Partmetadata();
        $partmetadata->fill((array)$validatedData);
        $partmetadata->user()->associate(Auth::user());
        /**
         * Hydrate l'objet Store
         */
        $store = new Store();
        $store->fill((array)$validatedData);
        $store->user()->associate(Auth::user());
        $store->location()->associate($location);
        /**
         * Hydrate l'objet Catalog
         */
        $catalog = new Catalog();
        $catalog->fill((array) $validatedData);
        $catalog->user()->associate(Auth::user());
        $catalog->provider()->associate($provider);
        /**
         * crée le réassortiment initial
         */
        $reassort = new Reassortement();
        $reassort->qty_add = $store->qty;
        $reassort->qty_before = 0;
        $reassort->user()->associate(Auth::user());
        $reassort->reason()->associate($reason);
        /**
         * Sauvegarde des objets
         */
        DB::transaction(function () use ($partmetadata, $store, $catalog, $reassort){
            $partmetadata->save();
            $store->partmetadata()->associate($partmetadata)->save();
            $catalog->partmetadata()->associate($partmetadata)->save();
            $reassort->store()->associate($store)->save();
        });

        /**
         * Redirection
         */
        return redirect()->route('store.index')->with('success','The part number has been saved');
    }

    /**
     * Sauvegarde des données suite à une mise à jour
     *
     * @param StorePartRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StorePartRequest $request)
    {
        /**
         * charge les objet existants
         */
        $partmetadata = Partmetadata::find($request->post('id'));
        $catalog = Catalog::find($request->post('cat_id'));
        /**
         * les valeurs validées
         */
        $validatedData = $request->validated();
        /**
         * mets à jour les objets
         */
        $partmetadata->fill((array) $validatedData);
        $catalog->fill((array) $validatedData);
        /**
         * sauvergarde
         */
        DB::transaction(function () use ($partmetadata, $catalog){
            $partmetadata->save();
            $catalog->save();
        });
        /**
         * redirection
         */
        return redirect()->route('store.index')->with('success','The part number has been saved');
    }

    /**
     * Imprime un sticker avec le code bar
     *
     * @param $id
     */
    public function barcodeSticker($id)
    {
        $partmetadata = Partmetadata::find($id);
        $mocoStickerModel = new MocoStickerModel(config('sticker.brother'));
        $mocoSticker = new MocoSticker($mocoStickerModel);
        $mocoSticker->setStickerHeader('Fassi Belgium');
        $mocoSticker->setStickerPartNumber($partmetadata->part_number);
        $mocoSticker->setStickerBarCode($partmetadata->bar_code);
        $mocoSticker->generate();
        $mocoSticker->Output('test.pdf');

    }

    public function TestbarcodeSticker(Request $request)
    {
        //$worksheets = Worksheet::all()->sortBy('number');
        $worksheets = Store::all()->sortBy('part_number');
        $pdf = new \TCPDF();
        $pdf->setCreator(PDF_CREATOR);
        $pdf->SetAuthor('MO Consult');
        $pdf->setTitle('Fiche de travail');
        $pdf->setHeaderData("barcode-scanner.jpg",PDF_HEADER_LOGO_WIDTH,"Worksheet");
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); // Whether to enable automatic paging
        $pdf->setPrintHeader(true);
        $pdf->setPageUnit('mm');
        $pdf->setMargins(15,10);
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
        $pdf->write(0,"Worksheets");
        foreach ($worksheets as $worksheet) {
            $pdf->ln();
            $pdf->write1DBarcode($worksheet->part_number, 'C39E', '', '', '', 18, 0.2, $style, 'N');
            $pdf->write(0,$worksheet->part_number);
        }
        $pdf->Output('test.pdf');
    }
}
