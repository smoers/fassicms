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
 *  Date : 4/12/20 10:12
 */

namespace App\Http\Controllers;

use App\Http\Requests\OutWorksheetValidationStepAjaxRequest;
use App\Moco\Common\Moco;
use App\Moco\Common\MocoAjaxValidation;
use App\Models\Part;
use App\Models\Reason;
use App\Models\Store;
use App\Models\ViewPartsTotal;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OutWorksheetController extends Controller
{
    use MocoAjaxValidation;

    protected $worksheetId;

    /**
     * OutWorksheetController constructor.
     */
    public function __construct()
    {
        //Le form request à utiliser
        $this->formRequest = new OutWorksheetValidationStepAjaxRequest();
        //L'id de la raison
        $this->worksheetId = config('moco.reason.worksheetId');

    }

    /**
     * Retour en stock par un scan
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function in()
    {
        return view('outworksheet.inworksheet-form');
    }

    /**
     * Formulaire de sortie sur fiche de travail
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function out()
    {
        return view('outworksheet.outworksheet-form');
    }

    /**
     * Répond à la requête ajax permettant de savoir si le numéro de fiche de travail
     * existe et son status de validation
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxWorksheetCheck(Request $request)
    {
        return response()->json(Moco::worksheetCheck($request));
    }

    /**
     * Ajax fonction permettant de contrôler si la pièce existe sur la fiche de travail
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxPartCheck(Request $request)
    {
        $result = [];
        /**
         * S'assure que le part number existe et est actif
         * car il faudra un prix pour la pièce lors de l'enregistrement de la transaction
         */
        if (Store::exist($request->post('part_number'))){
            /**
             * S'assure que ce part number existe sur la fiche de travail
             */
            $part = ViewPartsTotal::where('worksheet_id','=',$request->post('worksheet_id'))
                ->where('bar_code','=',$request->post('part_number'))
                ->where('qty_total','>=',1)
                ->first();
            if (!is_null($part)){
                /**
                 * La pièce existe avec une quantité >= 1
                 */
                $result = [
                    'checked' => true,
                    'msg' => null,
                ];
            } else {
                /**
                 * La pièce n'a jamais été sortie sur la fiche de travail
                 * ou la quantité restante est null
                 */
                $result = [
                    'checked' => false,
                    'msg' => trans('This part was not output on this worksheet or the quantity is null'),
                ];
            }
        } else {
            $result = [
                'checked' => false,
                'msg' => trans('This part does not exist or is disabled'),
            ];
        }
        return response()->json($result);
    }

    /**
     * Requête Ajax permettant de savoir si la pièce est en stock
     * et si la quantité demandée est disponible dans le stock
     *
     * @param Request $request
     */
    public function ajaxPartCheckOut(Request $request)
    {
        $result = [];
        /**
         * S'assure que le part number existe et est actif
         * car il faudra un prix pour la pièce lors de l'enregistrement de la transaction
         * On récupére pour lire la valeur du stock
         */
        $store = Store::getStoreByBarCode($request->post('part_number'));
        if (!is_null($store)){
            /**
             * S'assure qu'il y a suffisament de pièce en stock
             */
            if ($store->validateAvailableQuantity(intval($request->post('qty')))){
                $result = [
                    'checked' => true,
                    'stock_qty' => $store->qty,
                    'msg' => null,
                ];
            } else {
                $result = [
                    'checked' => false,
                    'stock_qty' => $store->qty,
                    'msg' => trans('The quantity available in stock is not enough')
                ];
            }
        } else {
            $result = [
                'checked' => false,
                'stock_qty' => null,
                'msg' => trans('This part does not exist or is disabled'),
            ];
        }
        return response()->json($result);
    }

    /**
     * S'assure que la qty en retour est valide
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxPartQtyCheck(Request $request)
    {
        $result = [];
        /**
         * S'assure que ce part number existe sur la fiche de travail avec une qty suffisante
         */
        $part = ViewPartsTotal::where('worksheet_id','=',$request->post('worksheet_id'))
            ->where('bar_code','=',$request->post('part_number'))
            ->where('qty_total','>=',$request->post('qty'))
            ->first();
        if (is_null($part)){
            $result = [
                'checked' => false,
                'msg' => trans('The quantity available on worksheet is not enough'),
            ];
        } else {
            $result = [
                'checked' => true,
                'msg' => null,
            ];
        }
        return response()->json($result);
    }

    /**
     * permet un retour en stock depuis le scan des barres codes
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function inTreatment(Request $request)
    {
        /**
         * Charge la fiche de travail
         */
        $worksheet = Worksheet::find($request->post('worksheet_id'));
        /**
         * la fiche est-elle validée ?
         */
        if (!$worksheet->validated){
            $parts = array_combine($request->post('parts'),$request->post('qtys'));
            /**
             * récupère  la raison
             */
            $reason = Reason::find($this->worksheetId);
            return DB::transaction(function () use ($parts, $worksheet, $reason){
                /**
                 * Parcours la liste des piéces à enregistrer
                 */
                foreach ($parts as $_part => $_qty){
                    /**
                     * on s'assure qu'il y a bien une pièce avec ce part number dans le stock et
                     * qu'elle est active
                     */
                    $store = Store::where('bar_code','=',$_part)->where('enabled','=',true)->lockForUpdate()->first();
                    if (is_null($store)){
                        DB::rollBack();
                        return redirect()->route('outworksheet.in')->with('error', trans('This part does not exist or is disabled ').$_part);
                    }
                    /**
                     * Recherche le prix de la pièce dans le catalogue
                     * uniquement pour l'année encours.
                     * Si le retour est null on lève une exception
                     */
                    $price = $store->getPrice();
                    if (is_null($price)) {
                        DB::rollBack();
                        return redirect()->route('outworksheet.in')->with('error',trans('No price is available for this part number ') . $_part);
                    }
                    /**
                     * On s'assure que la pièce existe sur la fiche de travail
                     * avec une quantité suffisante
                     */
                    $temp_part = ViewPartsTotal::where('worksheet_id','=',$worksheet->id)
                        ->where('bar_code','=',$_part)
                        ->where('qty_total','>=',$_qty)
                        ->first();
                    if (is_null($temp_part)){
                        DB::rollBack();
                        return redirect()->route('outworksheet.in')->with('error', trans('This part was not output on this worksheet or the quantity is not enough ').$_part);
                    }
                    /**
                     * La méthode de l'objet Store retourne l'objet Reassortement hydraté
                     * mais augmente aussi la valeur du stock
                     *
                     */
                    $reassort = $store->getReassortementHydrated($_qty,$reason,$worksheet->number);
                    /**
                     * Nouvel objet Part et hydratation
                     */
                    $part = new Part();
                    $part->part_number = $store->part_number;
                    $part->bar_code = $_part;
                    $part->description = $store->description;
                    $part->qty = intval($_qty);
                    $part->price = $price;
                    $part->type = 'R';
                    $part->year = Carbon::now()->year;
                    $part->user()->associate(Auth::user());
                    $part->worksheet()->associate($worksheet);
                    /**
                     * Sauvegarde des objets
                     */
                    $store->save();
                    $part->save();
                    $reassort->save();
                }
                return redirect()->route('dashboard')->with('success','The parts have been saved with success');
            });
        }
        return redirect()->route('outworksheet.in')->with('error', trans('This worksheet is validated.  No changes are authorized ').$worksheet->number);
    }

    /**
     * Enregistrement des pièces sortie la fiche de travail
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function outTreatment(Request $request)
    {

        /**
         * Charge la fiche de travail
         */
        $worksheet = Worksheet::find($request->post('worksheet_id'));
        /**
         * la fiche est-elle validée ?
         */
        if (!$worksheet->validated){
            $parts = array_combine($request->post('parts'),$request->post('qtys'));
            /**
             * récupère  la raison
             */
            $reason = Reason::find($this->worksheetId);
            return DB::transaction(function () use ($parts, $worksheet, $reason){
                /**
                 * Parcours la liste des piéces à enregistrer
                 */
                foreach ($parts as $_part => $_qty) {
                    /**
                     * on s'assure qu'il y a bien une pièce avec ce part number dans le stock et
                     * qu'elle est active
                     */
                    $store = Store::getStoreByBarCode($_part,true, true);
                    if (is_null($store)) {
                        DB::rollBack();
                        return redirect()->route('outworksheet.in')->with('error', trans('This part does not exist or is disabled ') . $_part);
                    }
                    /**
                     * Recherche le prix de la pièce dans le catalogue
                     * uniquement pour l'année encours.
                     * Si le retour est null on lève une exception
                     */
                    $price = $store->getPrice();
                    if (is_null($price)) {
                        DB::rollBack();
                        return redirect()->route('outworksheet.in')->with('error', trans('No price is available for this part number ') . $_part);
                    }
                    /**
                     * Validation et hydratation de l'objet Out
                     */
                    $out = $store->getOutHydrated($_qty, $reason, $worksheet->number);
                    if (is_null($out)){
                        DB::rollBack();
                        return redirect()->route('outworksheet.in')->with('error', trans('The stock quantity is not enough') . $_part);
                    }
                    $part = new Part();
                    $part->part_number = $store->part_number;
                    $part->bar_code = $_part;
                    $part->description = $store->description;
                    $part->qty = intval($_qty);
                    $part->price = $price;
                    $part->type = 'O';
                    $part->year = Carbon::now()->year;
                    $part->user()->associate(Auth::user());
                    $part->worksheet()->associate($worksheet);
                    /**
                     * Sauvegarde des objets
                     */
                    $store->save();
                    $part->save();
                    $out->save();
                }
                return redirect()->route('dashboard')->with('success','The parts have been saved with success');
            });
        }
        return redirect()->route('outworksheet.out')->with('error', trans('This worksheet is validated.  No changes are authorized ').$worksheet->number);
    }
}
