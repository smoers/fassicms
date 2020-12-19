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
use App\Models\Reason;
use App\Models\Store;
use Illuminate\Http\Request;

class OutController extends Controller
{
    use MocoAjaxValidation;
    protected $reason_filtering;

    /**
     * OutController constructor.
     */
    public function __construct()
    {
        $this->reason_filtering = config('moco.reason.filtering');
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
            ]
        );
    }

    /**
     * Sauvegarde la sortie de stock
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(OutRequest $request)
    {
        //Validation des données
        $validatedData = $request->validated();
        //Récupérer l'objet Store
        $store = Store::find($request->post('id'));
        //Récupérer L'objet
        $reason = Reason::find($validatedData['reason']);
        //Nouvel objet Out
        $out = $store->getOutHydrated(
            $validatedData['qty_pull'],
            $reason,
            $request->post('note')
        );
        //Sauvegarde les objets
        $out->save();
        $store->save();
        return redirect('reassort')->with('success', 'The new value of the stock has been saved');
    }

}
