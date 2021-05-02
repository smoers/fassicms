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
 *  Date : 26/11/20 19:15
 */

namespace App\Http\Controllers;

use App\Http\Requests\OutRequest;
use App\Moco\Common\MocoAjaxValidation;
use App\Models\Location;
use App\Models\Part;
use App\Models\Reason;
use App\Models\Store;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OutController extends Controller
{
    use MocoAjaxValidation;
    protected $reason_filtering;
    protected $reason_worksheetId;
    protected $reason_move_to;

    /**
     * OutController constructor.
     */
    public function __construct()
    {
        $this->reason_filtering = config('moco.reason.filtering');
        $this->reason_worksheetId = config('moco.reason.worksheetId');
        $this->reason_move_to = config('moco.reassort.moveTo');
        $this->formRequest = new OutRequest();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $store = Store::find($id);
        $reasons = Reason::where('option','=',$this->reason_filtering['out'])->orWhere('option','=',$this->reason_filtering['all'])->orderBy('reason')->get();
        return view('out.out-part-form',
            [
                '_store' => $store,
                '_reasons' => $reasons,
                '_move_to' => config('moco.reassort.moveTo'),
            ]
        );
    }

    /**
     * Sauvegarde la sortie de stock
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(OutRequest $request)
    {
        /**
         * Validation des données
         */
        $validatedData = $request->validated();
        /**
         * Récupérer l'objet Store
         */
        $store = Store::find($request->id);
        /**
         * Récupérer L'objet
         */
        $reason = Reason::find($validatedData['reason']);
        /**
         * si la raison est un mouvement de stock
         * vers une autre location
         */
        $store_dest = null;
        $reassort = null;
        if ($validatedData['reason'] == $this->reason_move_to){
            /**
             * nous allons mettre à jour le stock de destination
             */
            $store_dest = $store->partmetadata()->first()->getStoreByLocation($request->location_id);
            /**
             * si le stock n'existe pas pour cet emplacement on le crée
             */
            if (is_null($store_dest)) {
                $store_dest = new Store();
                $location = Location::find($request->location_id);
                $store_dest->qty = 0;
                $store_dest->location()->associate($location);
                $store_dest->partmetadata()->associate($store->partmetadata()->first());
                $store_dest->user()->associate(Auth::user());
            }
            /**
             * création de l'objet reassort
             */
            $reassort = $store_dest->getReassortementHydrated($validatedData['qty_pull'], $reason, $reason->reason);

        }
        /**
         * si la raison est une sortie sur worksheet
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
                return redirect()->route('reassort.index')->with('error',trans('No price is available for this part number ') . $part);
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
            $part->qty = $validatedData['qty_pull'];
            $part->price = $price;
            $part->year = Carbon::now()->year;
            $part->type = 'O';
            $part->user()->associate(Auth::user());
            $part->worksheet()->associate($worksheet);
        }
        /**
         * Nouvel objet Out
         */
        $out = $store->getOutHydrated(
            $validatedData['qty_pull'],
            $reason,
            $request->post('note')
        );
        /**
         * Sauvegarde les objets
         */
        DB::transaction(function() use($part,$out,$store,$store_dest,$reassort){
            /**
             * Si un objet part à été créé
             */
            if (!is_null($part))
                $part->save();
            /**
             * Si un objet Store_dest && Reassort ont été créés
             */
            if (!is_null($reassort) && !is_null($store_dest)){
                $store_dest->save();
                $reassort->store()->associate($store_dest)->save();
            }
            $out->save();
            $store->save();
        });
        return redirect()->route('reassort.index')->with('success', 'The new value of the stock has been saved');
    }

    /**
     * On cherche la valeur du stock de destination
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxOutCheck(Request $request)
    {
        $result = [
            'ckecked' => false,
            'dest_stock' => 0,
        ];
        /**
         * Objet Store
         */
        $store = Store::find($request->id);
        /**
         * Récupère l'objet Partmetadata
         */
        $partmetadata = $store->partmetadata()->first();
        /**
         * Depuis l'objet Partmetadata on cherche l'objet du stock de destination
         */
        $store_dest = $partmetadata->stores()->where('location_id','=',$request->location_id)->first();
        /**
         * Si on trouve l'objet on renvoie la valeur du stock
         */
        if(!is_null($store_dest)){
            $result['checked'] = true;
            $result['dest_stock'] = $store_dest->qty;
        }
        return  response()->json($result);
    }

}
