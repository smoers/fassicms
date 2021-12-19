<?php

namespace App\Http\Controllers;

use App\Moco\Reporting\MocoSelectRender;
use Illuminate\Http\Request;

class ReportingController extends Controller
{
    public function from(string $view){
        return view('reporting.from',[
            'title' => trans('Reporting from Worksheet'),
            'livewire' => 'report.'.$view,
        ]);
    }
}
