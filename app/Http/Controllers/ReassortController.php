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

use App\Models\Reassortement;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

/**
 * Class ReassortController
 * @package App\Http\Controllers
 */
class ReassortController extends Controller
{

    /**
     * Régles pour la validation
     * @return string[]
     */
    protected function rules()
    {
        return [
            'qty_add' => 'required|numeric|min:1|integer',
        ];
    }

    /**
     * Message pour la validation
     * @return array
     */
    protected function messages()
    {
        return [
            'qty_add.required' => trans('The number of added part is required'),
            'qty_add.min' => trans('The minimun of added part is 1'),
            'qty-add.integer' => trans('The number of pieces added must be an integer '),
        ];
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
        return view('reassort.reassort-part-form',[
           'store' => $store,
        ]);
    }

    /**
     * Enregistrment d'un réassortiment
     * @param Request $request
     */
    public function update(request $request)
    {
        //Validation des données
        $validatedData = $request->validate($this->rules(),$this->messages());
        //Récupérer l'objet Store
        $store = Store::find($request->post('id'));
        //Nouvel objet Reassortement
        $reassort = new Reassortement();
        $reassort->qty_add = $validatedData['qty_add'];
        $reassort->qty_before = $store->qty;
        $reassort->store()->associate($store);
        $reassort->user()->associate(Auth::user());
        //mise à jour de la quantité en stock
        $store->qty = $store->qty + $reassort->qty_add;
        //Sauvegarde des objets
        $reassort->save();
        $store->save();
        return redirect('reassort')->with('success', 'The new value of the stock has been saved');
    }

    /**
     * Validation real-time du formulaire
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ajaxValidation(request $request)
    {
        $this->validate($request, $this->rules(), $this->messages());
        return response()->json();
    }

}
