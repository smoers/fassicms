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

use App\Models\Out;
use App\Models\Reason;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutController extends Controller
{
    /**
     * Régles pour la validation
     * @return string[]
     */
    protected function rules()
    {
        return [
            'qty_pull' => 'required|numeric|min:1|integer|lte:qty_before',
            'reason' => 'required',
            'note' => 'max:255',
        ];
    }

    /**
     * Message pour la validation
     * @return array
     */
    protected function messages()
    {
        return [
            'qty_pull.required' => trans('The number of parts taken out is required'),
            'qty_pull.min' => trans('The minimun of parts taken out is 1'),
            'qty_pull.integer' => trans('The number of pieces taken out must be an integer '),
            'qty_pull.lte' => trans('The number of parts issued must be less than or equal to the number of parts in stock'),
            'reason.required' => trans('The reason is required'),
            'note.size' => trans('The maximum size for a note is 255 characters'),
        ];
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $store = Store::find($id);
        $reasons = Reason::where('option','=','O')->orderBy('reason')->get();
        return view('out.out-part-form',
            [
                '_store' => $store,
                '_reasons' => $reasons,
            ]
        );
    }

    /**
     * Sauvegarde la sortie de stock
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        //Validation des données
        $validatedData = $request->validate($this->rules(),$this->messages());
        //Récupérer l'objet Store
        $store = Store::find($request->post('id'));
        //Récupérer L'objet
        $reason = Reason::find($validatedData['reason']);
        //Nouvel objet Out
        $out = new Out();
        $out->qty_pull = $validatedData['qty_pull'];
        $out->note = $validatedData['note'];
        $out->qty_before = $store->qty;
        $out->store()->associate($store);
        $out->reason()->associate($reason);
        $out->user()->associate(Auth::user());
        //mise à jour de la quantité en stock
        $store->qty = $store->qty - $out->qty_pull;
        $out->save();
        $store->save();
        return redirect('reassort')->with('success', 'The new value of the stock has been saved');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ajaxValidation(Request $request)
    {
        $this->validate($request, $this->rules(), $this->messages());
        return response()->json();
    }
}
