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

use App\Models\Part;
use App\Models\Store;
use Illuminate\Http\Request;
use ArrayObject;

class OutWorksheetController extends Controller
{
    protected function rules()
    {
        return [
        'number' => 'required|numeric|integer|between:20200000000000,20600000000000|exists:worksheets,number'
        ];
    }

    protected function messages()
    {
        return [
            'required' => trans('The :attribute is required'),
            'numeric' => trans('The :attribute must be numeric'),
            'size' => trans('The :attribute must have a size of :size'),
            'exists' => trans('The :attribute does not exist')
        ];
    }

    protected function attributes()
    {
        return [
            'number' => trans('number of the worksheet'),
        ];
    }

    public function index()
    {
        return view('outworksheet.outworksheet-form')->with('step',10);
    }

    public function out(Request $request)
    {
        $validatedData = $request->validate($this->rules(), $this->messages(), $this->attributes());
        return view('outworksheet.outworksheet-form')->with('step',20);
    }

    public function treatment(Request $request)
    {
        //list des parts
        $parts_object = new ArrayObject();
        $parts_object->setFlags(ArrayObject::STD_PROP_LIST|ArrayObject::ARRAY_AS_PROPS);
        //Variables
        $flag = null; //P ou Q
        $previous_part = null;
        $previous_qty = null;

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
                            $flag = null;
                        }
                    }
                }
            }

        } else {
            return redirect('dashboard')->with('error','Your pickup list was empty, your out of stock has been canceled.');
        }

    }
}
