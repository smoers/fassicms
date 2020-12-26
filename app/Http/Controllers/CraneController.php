<?php

namespace App\Http\Controllers;

use App\Http\Requests\CraneRequest;
use App\Moco\Common\MocoAjaxValidation;
use App\Models\Crane;
use Illuminate\Http\Request;

class CraneController extends Controller
{
    use MocoAjaxValidation;

    public function __construct()
    {
        $this->formRequest = new CraneRequest();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crane.crane-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crane/crane');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->formRequest->setRequestArray($request->all());
        $validatedData = $this->validate($request,$this->formRequest->rules(),$this->formRequest->messages(),$this->formRequest->attributes());
        $crane = new Crane();
        $crane->fill($validatedData);
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
            $route = route('worksheet.create');
        }

        return redirect($route)->with('success','The crane has been saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
