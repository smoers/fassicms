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
use App\Models\Store;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ArrayObject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function out(OutWorksheetStepRequest $request)
    {
        $validatedData = $request->validated();
        $request->session()->put('worksheet_number', $validatedData['number']);
        return view('outworksheet.outworksheet-form',[
            'step' => 20,
            'number' => $validatedData['number'],
        ]);
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
                        } elseif (Store::exist($part)) { // s'assure que le part number existe dans la table Stores
                            //comme la pièce n'existe pas dans la liste des objet, on crée un nouvel objet avec la qty = 1 ou avec la previous qty
                            if ($flag == 'Q' && !is_null($previous_qty) && $previous_qty != 0){
                                $parts_object[$part] = new Part(['part_number' => $part, 'qty' => $previous_qty]);
                            } else {
                                $parts_object[$part] = new Part(['part_number' => $part, 'qty' => 1]);
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
                $store = Store::where('part_number', '=', $value->part_number)->where('enabled', '=', true)->first();
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
            }
            //on charge le formulaire de validation
            return view('outworksheet.outworksheet-form',[
                'step' => 30,
                'parts' => $partsToForm,
            ])->with('info', $info);
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
}
