<?php

namespace App\Http\Controllers;

use App\Models\ViewPartmetadatasReassort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * Affiche le Dashboard
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
        /**
         * doit on afficher la liste des pièces à réapprovisionner
         */
        $asReassort = false;
        if (Auth::user()->can('show reassort list'))
            if (count(ViewPartmetadatasReassort::all()))
                $asReassort = true;

        return view('root.dashboard',[
            'asReassort' => $asReassort,
        ]);
    }


}
