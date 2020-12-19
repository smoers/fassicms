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
use App\Models\Reason;
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

    use MocoAjaxValidation;

    /**
     * ReassortController constructor.
     */
    public function __construct()
    {
        $this->formRequest = new ReassortRequest();
        $this->reason_filtering = config('moco.reason.filtering');
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
        $reasons = Reason::where('option','=',$this->reason_filtering['reassort'])->orWhere('option','=',$this->reason_filtering['all'])->orderBy('reason')->get();
        return view('reassort.reassort-part-form',[
            '_store' => $store,
            '_reasons' => $reasons
        ]);
    }

    /**
     * Enregistrment d'un réassortiment
     *
     * @param Request $request
     */
    public function update(ReassortRequest $request)
    {
        //Validation des données
        $validatedData = $request->validated();
        //Récupérer l'objet Store
        $store = Store::find($request->post('id'));
        //Récupérer L'objet
        $reason = Reason::find($validatedData['reason']);
        //Nouvel objet Reassortement
        $reassort = new Reassortement();
        $reassort->qty_add = $validatedData['qty_add'];
        $reassort->note = $request->post('note');
        $reassort->qty_before = $store->qty;
        $reassort->store()->associate($store);
        $reassort->reason()->associate($reason);
        $reassort->user()->associate(Auth::user());
        //mise à jour de la quantité en stock
        $store->increaseQuantity($reassort->qty_add);
        //Sauvegarde des objets
        $reassort->save();
        $store->save();
        return redirect('reassort')->with('success', 'The new value of the stock has been saved');
    }

}
