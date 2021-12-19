<?php

namespace App\Http\Controllers;

use App\Http\Requests\CraneRequest;
use App\Moco\Common\MocoAjaxValidation;
use App\Moco\Common\MocoModelForConsult;
use App\Models\Truckscrane;
use Illuminate\Support\Facades\Auth;

class CraneController extends Controller
{
    use MocoAjaxValidation;

    public function __construct()
    {
        $this->formRequest = new CraneRequest();
    }

    /**
     * Liste les grues
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('crane.crane-list');
    }

    /**
     * Affiche le formulaire permettant d'ajouter une grues
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('crane.crane-v2',[
            'title' => trans('Add or modify a crane'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $truckscrane = Truckscrane::find($id);
        if (!is_null($truckscrane)){
            $mocoModelForConsult = new MocoModelForConsult($truckscrane,Auth::user()->can('consult crane extended'));
            return view('consult.consult',
                [
                    'title' => trans('Consult Crane'),
                    'consult' => $mocoModelForConsult->getBladeLayout(),
                    'return' => route('crane.index'),
                ]);
        }
        return redirect()->route('crane.index');
    }

    /**
     * Permet de modifier une grue
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $trucksCrane = Truckscrane::find($id);
        return view('crane.crane-v2',[
            'title' => trans('Add or modify a crane'),
            'serial' => $trucksCrane->serial,
        ]);

    }
}
