<?php

namespace App\Http\Controllers;

use App\Moco\Common\Moco;
use App\Moco\Common\MocoAjaxValidation;
use App\Models\Crane;
use App\Models\Customer;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorksheetController extends Controller
{
    use MocoAjaxValidation;

    public function __construct()
    {

    }

    public function create()
    {
        $worksheet = new Worksheet();
        $worksheet->number = Moco::worksheetNumber();
        $worksheet->date = Carbon::now('Europe/Brussels')->format('d/m/yy');
        $worksheet->oil_filtered = false;
        $worksheet->crane()->associate(new Crane());
        $worksheet->customer()->associate(new Customer());
        return view('worksheet.worksheet-form',[
                '_action' => route('worksheet.store'),
                'worksheet' => $worksheet,
            ]);
    }
}
