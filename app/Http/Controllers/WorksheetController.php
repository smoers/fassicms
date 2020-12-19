<?php

namespace App\Http\Controllers;

use App\Moco\Common\MocoAjaxValidation;
use Illuminate\Http\Request;

class WorksheetController extends Controller
{
    use MocoAjaxValidation;

    public function __construct()
    {

    }

    public function create()
    {
        return view('worksheet.worksheet-form',[
                '_action' => route('worksheet.store'),
            ]);
    }
}
