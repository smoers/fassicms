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
 *  Date : 22/11/20 19:49
 */

namespace App\Http\Controllers;

use App\Http\Requests\ReassortRequest;
use App\Moco\Common\MocoAjaxValidation;
use App\Models\Part;
use App\Models\Partmetadata;
use App\Models\Reason;
use App\Models\Reassortement;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class ReassortController
 * @package App\Http\Controllers
 */
class ReassortController extends Controller
{

    use MocoAjaxValidation;
    protected $reason_filtering;
    protected $reason_worksheetId;
    protected $reason_move_from;

    /**
     * ReassortController constructor.
     */
    public function __construct()
    {
        $this->formRequest = new ReassortRequest();
        $this->reason_filtering = config('moco.reason.filtering');
        $this->reason_worksheetId = config('moco.reason.worksheetId');
        $this->reason_move_from = config('moco.reassort.moveFrom');
    }


    /**
     * Retourne la liste des piéces en stock et actives
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('reassort.reassort-list-main');
    }

    /**
     * Retourne le formulaire de réassortiment d'une pièces
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $store = Store::find($id);
        $partmetadata = $store->partmetadata()->first();
        $reasons = Reason::where('option','=',$this->reason_filtering['reassort'])->orWhere('option','=',$this->reason_filtering['all'])->orderBy('reason')->get();
        return view('reassort.reassort-part-form',[
            '_store' => $store,
            '_reasons' => $reasons,
            '_partmetadata' => $partmetadata,
            '_move_from' => config('moco.reassort.moveFrom'),
        ]);
    }

    /**
     * Enregistrment d'un réassortiment
     *
     * @param Request $request
     */
    public function update(Request $request)
    {
        $this->formRequest->setRequestArray($request->all());
        //Validation des données
        $validatedData = $this->validate($request,$this->formRequest->rules(),$this->formRequest->messages(),$this->formRequest->attributes());
        //Récupérer l'objet Store
        $store = Store::find($request->post('id'));
        //Récupérer L'objet
        $reason = Reason::find($validatedData['reason']);
        /**
         * si la raison est un mouvement de stock
         * depuis une autre location
         */
        $store_src = null;
        $out = null;
        if ($validatedData['reason'] == $this->reason_move_from){
            /**
             * on retrouve le stock source depuis le stock de destination
             */
            $store_src = $store->partmetadata()->first()->getStoreByLocation($request->location_id);
            /**
             * création de l'objet Out et mise à jour de la valeur du stock
             */
            $out = $store_src->getOutHydrated($validatedData['qty_add'],$reason, $reason->reason);
        }
        /**
         * si la raison est un retour sur worksheet
         * il faut créer un objet part
         */
        $part = null;
        if ($validatedData['reason'] == $this->reason_worksheetId){
            /**
             * Recherche le prix de la pièce dans le catalogue
             * uniquement pour l'année encours.
             * Si le retour est null on lève une exception
             */
            $price = $store->getPrice();
            if (is_null($price)) {
                return redirect()->route('reassort')->with('error',trans('No price is available for this part number ') . $part);
            }
            /**
             * recherche l'id de la worksheet
             */
            $worksheet = Worksheet::where('number','=',$validatedData['note'])->first();
            /**
             * Hydrate l'objet Part
             */
            $part = new Part();
            $part->part_number = $store->partmetadata()->first()->part_number;
            $part->bar_code = $store->partmetadata()->first()->bar_code;
            $part->description = $store->partmetadata()->first()->description;
            $part->qty = $validatedData['qty_add'];
            $part->price = $price;
            $part->year = Carbon::now()->year;
            $part->type = 'R';
            $part->location()->associate($store->location()->first());
            $part->user()->associate(Auth::user());
            $part->worksheet()->associate($worksheet);
        }
        /**
         * création de l'objet Reassort et mise à jour de la quantité
         */
        $reassort = $store->getReassortementHydrated($validatedData['qty_add'],$reason,$request->note);
        /**
         * Sauvegarde des objets
         */
        DB::transaction(function () use ($store, $store_src, $part, $reassort, $out) {
            /**
             * Si un objet part à été créé
             */
            if (!is_null($part))
                $part->save();
            /**
             * Si un objet store_src & out ont été créés
             */
            if((!is_null($store_src)) && !is_null($out)){
                $store_src->save();
                $out->save();
            }
            $reassort->save();
            $store->save();
        });

        return redirect()->route('reassort.index')->with('success', 'The new value of the stock has been saved');
    }

    /**
     * Retourne la valeur du stock pour l'emplacement source
     * si ce dernier est null ou inférieur à 1 une erreur est retournée
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxReassortCheck(Request $request)
    {
        $result = [
            'checked' => false,
            'src_stock' => 0,
            'msg' => null,
        ];
        /**
         * Objet de destination
         */
        $store = Store::find($request->id);
        /**
         * Object source
         */
        $store_src = $store->partmetadata()->first()->getStoreByLocation($request->location_id);
        /**
         * Si l'objet source n'est pas null and la qty est supérieur ou egal à 1
         */
        if (!is_null($store_src) && $store_src->qty >= 1){
            $result['checked'] = true;
            $result['src_stock'] = $store_src->qty;
        } else {
            $result['msg'] = trans('There is no stock available at this location');
        }
        return response()->json($result);
     }

}
