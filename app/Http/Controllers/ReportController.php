<?php

namespace App\Http\Controllers;

use App\Reports\ReassortLevel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reassortLevel()
    {
        $report = new ReassortLevel();
        $report->run();
        return view('reports.reassort-level',['report' => $report]);
    }
}
