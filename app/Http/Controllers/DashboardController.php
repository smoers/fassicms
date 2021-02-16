<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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
        /**
         * Défini le language de l'utilisateur
         */
        App::setLocale(Auth::user()->language);

        return view('root/dashboard');
    }


}
