<?php

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
            'qty_pull' => 'required|numeric|min:1|integer',
            'reason' => 'required',
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
            'reason.required' => trans('The reason is required'),
        ];
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $store = Store::find($id);
        $reasons = Reason::all()->sortBy('reason');
        return view('out.out-part-form',
            [
                '_store' => $store,
                '_reasons' => $reasons,
            ]
        );
    }

    public function update(Request $request)
    {
        //Validation des données
        $validatedData = $request->validate($this->rules(),$this->messages());
        //Récupérer l'objet Store
        $store = Store::find($request->post('id'));
        //Récu^érer L'objet
        $reason = Reason::find($validatedData['reason']);
        //Nouvel objet Out
        $out = new Out();
        $out->qty_pull = $validatedData['qty_pull'];
        $out->qty_before = $store->qty;
        $out->store()->associate($store);
        $out->reason()->associate($reason);
        $out->user()->associate(Auth::user());
        //mise à jour de la quantité en stock
        $store->qty = $store->qty - $out->qty_pull;
        dd([$store, $out]);
        return redirect('reassort')->with('success', 'The new value of the stock has been saved');
    }

    public function ajaxValidation(Request $request)
    {
        $this->validate($request, $this->rules(), $this->messages());
        return response()->json();
    }
}
