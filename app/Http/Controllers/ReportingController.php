<?php

namespace App\Http\Controllers;


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
