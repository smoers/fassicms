<?php

namespace App\Http\Controllers;

use App\Http\Requests\CraneRequest;
use App\Moco\Common\MocoAjaxValidation;
use App\Moco\Common\MocoModelForConsult;
use App\Models\Crane;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        return view('crane.crane',
        [
            'action' => route('crane.store'),
            'crane' => new Crane(),
            'title' => trans('Add a crane'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->formRequest->setRequestArray($request->all());
        $validatedData = $this->validate($request,$this->formRequest->rules(),$this->formRequest->messages(),$this->formRequest->attributes());
        $crane = new Crane();
        $crane->fill($validatedData);
        $crane->user()->associate(Auth::user());
        $crane->save();
        /**
         * récupère la route par défaut
         */
        $route = route('dashboard');
        /**
         * On controle si la demande d'ajout a été faite depuis le formulaire d'ajout d'une fiche de travail
         */
        if ($request->session()->exists('worksheet_form')){
            $worksheet_form = $request->session()->get('worksheet_form');
            $worksheet_form['crane_id'] = $crane->id;
            $worksheet_form['serial'] = $crane->serial;
            $worksheet_form['model'] = $crane->model;
            $worksheet_form['plate'] = $crane->plate;
            $request->session()->put('worksheet_form',$worksheet_form);
            $route = $request->session()->get('worksheet_source');
        }

        return redirect($route)->with('success','The crane has been saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $crane = Crane::find($id);
        if (!is_null($crane)){
            $mocoModelForConsult = new MocoModelForConsult($crane,Auth::user()->can('consult crane extended'));
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
        $crane = Crane::find($id);
        return view('crane.crane',
            [
                'crane' => $crane,
                'action' => route('crane.update',$id),
                'title' => trans('Modify a crane'),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->formRequest->setRequestArray($request->all());
        $validatedData = $this->validate($request,$this->formRequest->rules(),$this->formRequest->messages(),$this->formRequest->attributes());
        $crane = Crane::find($id);
        $crane->fill($validatedData);
        $crane->user()->associate(Auth::user());
        $crane->save();
        return redirect()->route('crane.index')->with('success', trans('The crane has been modified with success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
