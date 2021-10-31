<?php

namespace App\Http\Controllers;

use App\Moco\Reporting\MocoSelectRender;
use Illuminate\Http\Request;

class ReportingController extends Controller
{
    public function from(){

        return view('reporting.from_worksheet',[
            'title' => trans('Reporting from Worksheet'),
        ]);
    }
}
