<?php

namespace App\Http\Controllers;

use App\Moco\Reporting\MocoSelectRender;
use Illuminate\Http\Request;

class ReportingController extends Controller
{
    public function from(int $id){
        $report = config('moco.datatable.report.'.$id);
        return view('reporting.from',[
            'title' => trans($report['title']),
            'livewire' => $report['view'],
        ]);
    }
}
