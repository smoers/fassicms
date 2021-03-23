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

use App\Http\Requests\OutWorksheetStepRequest;
use App\Http\Requests\OutWorksheetValidationStepAjaxRequest;
use App\Http\Requests\OutWorksheetValidationStepRequest;
use App\Moco\Common\MocoAjaxValidation;
use App\Models\Part;
use App\Models\Reason;
use App\Models\Reassortement;
use App\Models\Store;
use App\Models\ViewPartsTotal;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ArrayObject;
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
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('outworksheet.outworksheet-form')->with('step',10);
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
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function outbis(OutWorksheetStepRequest $request)
    {
        $validatedData = $request->validated();
        $request->session()->put('worksheet_number', $validatedData['number']);
        return view('outworksheet.outworksheet-form',[
            'step' => 20,
            'number' => $validatedData['number'],
        ]);
    }

    public function out()
    {
        return view('outworksheet.outworksheet-bis-form');
    }

    /**
     * Cette méthode va traiter les données des pièces sorties par un scan
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Contracts\View\View
     */
    public function treatment(Request $request)
    {
        //list des parts
        $parts_object = new ArrayObject();
        $parts_object->setFlags(ArrayObject::STD_PROP_LIST|ArrayObject::ARRAY_AS_PROPS);
        //Variables
        $flag = null; //P ou Q
        $previous_part = null;
        $previous_qty = null;
        $partsNoExists = null;
        $store = null;

        $parts = $request->post('parts');
        if($parts != ''){
            $parts_array = preg_split('/(\r\n)/m',$parts);

            //Traitement de la liste
            foreach ($parts_array as $part) {
                if($part != '') {   //si la valeur n'est pas null on trait
                    //Tester si c'est une qty, max 3 caractères, numérique, > 0
                    if (strlen($part) <= 3 && is_numeric($part) && intval($part) > 0){ //Cas d'une quantité
                        if(is_null($flag)) //la QTY est avant le part number
                            $flag = 'Q';
                        if ($flag == 'P'){
                            //On ajoute la valeur au part number précédent
                            $parts_object[$previous_part]->qty = intval($part);
                        } else {
                            //On sauve la valeur QTY pour ajouter au prochain part number
                            $previous_qty = intval($part);
                        }
                    } else { //Cas d'un numéro de pièce
                        if(is_null($flag)) //la part number est avant la QTY
                            $flag = 'P';
                        $previous_part = $part;
                        if ($parts_object->offsetExists($part)){
                            //Comme la pièce existe dans la liste des objets, on augmente la qty de 1 ou de la previous qty
                            if ($flag == 'Q' && !is_null($previous_qty) && $previous_qty != 0){
                                $parts_object[$part]->qty = $previous_qty;
                            } else {
                                $parts_object[$part]->qty = $parts_object[$part]->qty + 1;
                            }
                        } elseif (!is_null($store = Store::getStoreByBarCode($part))) { // s'assure que le part number existe dans la table Stores
                            //comme la pièce n'existe pas dans la liste des objet, on crée un nouvel objet avec la qty = 1 ou avec la previous qty
                            if ($flag == 'Q' && !is_null($previous_qty) && $previous_qty != 0){
                                $parts_object[$part] = new Part(['part_number' => $store->part_number, 'bar_code' => $part, 'qty' => $previous_qty]);
                            } else {
                                $parts_object[$part] = new Part(['part_number' =>  $store->part_number, 'bar_code' => $part, 'qty' => 1]);
                            }
                        } else {
                            $partsNoExists .= ','.$part;
                            $flag = null;
                        }
                    }
                }
            }
            /**
             * Validation manuelle des valeurs
             * Cela va permettre d'afficher les erreurs de qty lors du chargement
             * du formulaire de validation
             */
            $partsToForm = array();
            foreach ($parts_object->getArrayCopy() as  $key => $value){
                $array = [
                    'part' => $value,
                    'enough' => true,
                    'qty_before' => null
                ];
                //A ce niveau toutes les pièces de la liste existe
                $store = Store::getStoreByPartNumber($value->part_number);
                $array['enough'] = $store->validateAvailableQuantity($value->qty);
                $array['qty_before'] = $store->qty;
                $partsToForm[$key] = $array;
            }
            /**
             * Charge les valeurs dans une variable de session
             */
            $request->session()->put('partsToForm',$partsToForm);
            /**
             * Message pour l'utilisateur
             */
            if (is_null($partsNoExists)){
                $info = trans('The treatment was completed without remarks');
            } else {
                $info = trans('The treatment was completed with remarks.
                The following bar code are not existing in the stock ').$partsNoExists;
            }
            $request->session()->flash('info',$info);
            //on charge le formulaire de validation
            return view('outworksheet.outworksheet-form',[
                'step' => 30,
                'parts' => $partsToForm,
                ]);
        } else {
            //la zone texte étant vide on génère une erreur
            return redirect('dashboard')->with('error','Your pickup list was empty, your out of stock has been canceled.');
        }

    }

    /**
     * Cette méthode est uniquement appelée si la validation du formulaire
     * de traitement est incorrect.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function treatmentForm(Request $request)
    {
        return view('outworksheet.outworksheet-form',[
                'step' => 30,
                'parts' => $request->session()->get('partsToForm'),
            ]
        );
    }

    /**
     * Cette méthode va se charger de sauvegarder et de créer les enregistrements
     * liés à une sortie de stock sur une fiche de travail
     *
     * @param OutWorksheetValidationStepRequest $request
     * @return \Illuminate\Routing\Redirector
     * @throws \ErrorException
     */
    public function validation(OutWorksheetValidationStepRequest $request)
    {

        //Obtenir les données (le worksheet number existe car validé)
        $parts = $request->validated()['part_number'];
        $qtys = $request->validated()['qty'];
        $number = $request->session()->get('worksheet_number');

        return DB::transaction(function () use ($parts, $qtys, $number, $request) {
            foreach ($parts as $key => $part) {
                //Recherche les objet nécessaire dans les relations
                $store = Store::where('part_number', '=', $part)->where('enabled', '=', true)->lockForUpdate()->first();
                $worksheet = Worksheet::where('number', '=', $number)->first();
                $reason = Reason::find($this->worksheetId);
                $out = $store->getOutHydrated($qtys[$key], $reason, $number);

                /**
                 * Si Out est null alors cela signifie que la qty est insuffisante
                 * on lève une exception
                 */
                if (is_null($out)) {
                    DB::rollBack();
                    return redirect()->route('outworksheet.treatmentform')->with('error',trans('The quantity in stock is not enough for the quantity requested for part number ') . $part);
                }

                /**
                 * Recherche le prix de la pièce dans le catalogue
                 * uniquement pour l'année encours.
                 * Si le retour est null on lève une exception
                 */
                $price = $store->getPrice();
                if (is_null($price)) {
                    DB::rollBack();
                    return redirect()->route('outworksheet.treatmentform')->with('error',trans('No price is available for this part number ') . $part);
                }

                /**
                 * hydrate l'objet Part
                 */
                $part_obj = new Part();
                $part_obj->part_number = $store->part_number;
                $part_obj->bar_code = $store->bar_code;
                $part_obj->description = $store->description;
                $part_obj->qty = intval($qtys[$key]);
                $part_obj->price = $price;
                $part_obj->year = Carbon::now()->year;
                $part_obj->user()->associate(Auth::user());
                $part_obj->worksheet()->associate($worksheet);

                /*
                 * Sauvegarde
                 */
                $out->save();
                $store->save();
                $part_obj->save();
            }
            return redirect()->route('outworksheet.index')->with('success', 'The parts have been output on the worksheet');
        });

    }

    /**
     * Répond à la requête ajax permettant de savoir si le numéro de fiche de travail
     * existe et son status de validation
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxWorksheetCheck(Request $request)
    {
        $result = [];
        $worksheet = Worksheet::where('number','=',$request->post('number'))->first();
        if (!is_null($worksheet) && !$worksheet->validated){
            $result = [
                'checked' => true,
                'id' => $worksheet->id,
                'msg' => null,
            ];
        } elseif (!is_null($worksheet) && $worksheet->validated){
            $result = [
                'checked' => false,
                'id' => $worksheet->id,
                'msg' => trans('This worksheet is validated.  No changes are authorized'),
            ];
        } else {
            $result = [
                'checked' => false,
                'id' => null,
                'msg' => trans('This worksheet does not exist in the system'),
            ];
        }
        return response()->json($result);
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
