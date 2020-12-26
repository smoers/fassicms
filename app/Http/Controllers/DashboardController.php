<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        /**
         * On détruit la variable de session worksheet_form si elle existe.
         * Cas où l'ajout d'une fiche de travail a été canceled
         */
        if ($request->session()->exists('worksheet_form'))
            $request->session()->remove('worksheet_form');

        return view('root/dashboard');
    }


}
