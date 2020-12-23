<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorksheetRequest;
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
        $this->formRequest = new WorksheetRequest();
    }

    public function create()
    {
        $worksheet = new Worksheet();
        $worksheet->number = Moco::worksheetNumber();
        $worksheet->date = Carbon::now('Europe/Brussels')->format('d/m/Y');
        $worksheet->oil_filtered = false;
        $worksheet->crane()->associate(new Crane());
        $worksheet->customer()->associate(new Customer());
        return view('worksheet.worksheet-form',[
                '_action' => route('worksheet.store'),
                'worksheet' => $worksheet,
            ]);
    }

    public function store(WorksheetRequest $request)
    {
        /**
         * Récupère les données validées
         */
        $validatedData = $request->validated();

        /**
         * Recherche les objects liés
         */
        $crane = Crane::find($validatedData['crane_id']);
        $customer = Customer::find($validatedData['customer_id']);

        /**
         * Hydrate le nouvel object worksheet
         */
        $worksheet = new Worksheet();
        $worksheet->number = $validatedData['number'];
        $worksheet->date = $validatedData['date'];
        $worksheet->remarks = $validatedData['remarks'];
        $worksheet->work = $validatedData['work'];
        $worksheet->oil_replace = $validatedData['oil_replace'];
        $worksheet->oil_filtered = $validatedData['oil_filtered'];
        $worksheet->customer()->associate($customer);
        $worksheet->crane()->associate($crane);

        /**
         * sauvegarde l'objet
         */
        $worksheet->save();

        /**
         * redirection
         */
        return redirect()->route('dashboard')->with('success','The worksheet has been saved ');
    }

    /**
     * Retourne un Json des objets
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSelect(Request $request)
    {
        $return = null;
        if ($request->post('whatIs') == 'customer'){
            $return = Customer::where('name','like','%'.$request->post('name').'%' )->get();
        } elseif ($request->post('whatIs') == 'crane'){
            $return = Crane::where('serial','like','%'.$request->post('serial').'%')->get();
        }
        return response()->json($return);
    }

    public function addOption(Request $request)
    {
        dd($request->all());
    }
}
