<?php
/*
 * Copyright (c) 2021. MO Consult
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 *
 *  Company : Fassi Belgium
 *  Developer : MO Consult
 *  Author : Moers Serge
 *  Date : 4/01/21 17:59
 */

namespace App\Http\Controllers;

use App\Exports\CompleteWorksheetExport;
use App\Http\Requests\WorksheetRequest;
use App\Moco\Common\Moco;
use App\Moco\Common\MocoAjaxValidation;
use App\Moco\Common\MocoArrayFieldsValues;
use App\Moco\Common\MocoModelForConsult;
use App\Moco\Common\MocoOptions;
use App\Moco\Common\MocoOptionsListWorksheetPrint;
use App\Moco\Printer\MocoWorksheet;
use App\Models\Truckscrane;
use App\Models\ViewPartsSignedValues;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorksheetController extends Controller
{
    use MocoAjaxValidation;
    use MocoArrayFieldsValues;

    protected $info_fields = [
        'crane_id' => null,
        'customer_id' => null,
        'serial' => '',
        'model' => '',
        'plate' => '',
        'name' => '',
        'address' => '',
        'phone' => '',
        'mail' => '',
        'vat' => '',
    ];

    /**
     * WorksheetController constructor.
     */
    public function __construct()
    {
        $this->formRequest = new WorksheetRequest();
    }

    /**
     * Permet de lister les fiches de travail
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('worksheet.worksheet-list');
    }

    /**
     * Création d'une nouvelle fiche de travail
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        /**
         * Nouvelle objet
         */
        $worksheet = new Worksheet();
        /**
         * Défini la source dans une variable de session
         */
        $request->session()->put('worksheet_source',route('worksheet.create'));
        /**
         * Test l'existence d'une session avec la clé worksheet_form
         */
        if ($request->session()->exists('worksheet_form')){
            /**
             * Récupère l'objet Worksheet dans la session
             */
            $worksheet = $request->session()->pull('worksheet_form');

        } else {
            /**
             * Pas de variable de session définie
             * Place les valeur par défaut
             */
            $worksheet->number = Moco::worksheetNumber();
            $worksheet->date = Carbon::now('Europe/Brussels')->format('d/m/Y');
            $worksheet->oil_filtered = false;
            $worksheet->warranty = false;
            $worksheet->validated = false;
            $worksheet->truckscrane()->associate(new Truckscrane());
        }

        return view('worksheet.worksheet-form-v2',[
                'worksheet' => $worksheet,
                'title' =>trans('Add a worksheet'),
            ]);
    }

    public function templateCreate()
    {
        return view('worksheet.worksheet-template-create',[
            'title' => trans('Worksheet template creation'),
        ]);
    }

    public function templateStore(Request $request)
    {
        $error = null;
        foreach ($request->number as $number){
            if(Worksheet::where('number', $number)->exists()){
                $error .= $number.',';
            } else {
                $worksheet = new Worksheet();
                $worksheet->number = $number;
                $worksheet->user()->associate(Auth::user());
                $worksheet->save();
            }
        }
        if (is_null($error))
            return redirect()->route('worksheet.index')->with('success', trans('The worksheet template have been saved'));
        else
            return redirect()->route('worksheet.index')->with('warning', trans('The following worksheet template have not been saved : ').$error);
    }

    /**
     * Permet de modifier une fiche de travail existante
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, $id)
    {
        /**
         * Défini la source dans une variable de session
         */
        $request->session()->put('worksheet_source',route('worksheet.edit',['id'=>$id]));
        /**
         * Test l'existence d'une session avec la clé worksheet_form
         */
        if ($request->session()->exists('worksheet_form')) {
            /**
             * Récupère l'objet Worksheet dans la session
             */
            $worksheet = $request->session()->pull('worksheet_form');

        } else {
            /**
             * Récupère les objets
             */
            $worksheet = Worksheet::find($id);
        }
        return view('worksheet.worksheet-form-v2',[
            'title' => trans('Modify a worksheet'),
            'worksheet' => $worksheet,
        ]);
    }

    /**
     * Permet l'affichage des données en mode consultation
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $worksheet = Worksheet::find($id);
        if (!is_null($worksheet)){
            $mocoModelForConsult = new MocoModelForConsult($worksheet,Auth::user()->can('consult worksheet extended'));
            return view('consult.consult',
                [
                    'title' => trans('Consult Worksheet'),
                    'consult' => $mocoModelForConsult->getBladeLayout(),
                    'return' => route('worksheet.index'),
                ]);
        }
        return redirect()->route('worksheet.index');
    }

    /**
     * Retourne un Json des objets
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSelect(Request $request)
    {
        $return = Truckscrane::query()->leftJoin('customers','customers.id','=','truckscranes.customer_id')
            ->where('serial','like','%'.$request->search.'%')
            ->orWhere('plate','like','%'.$request->search.'%')
            ->orWhere('crane_model','like','%'.$request->search.'%')
            ->orWhere('brand','like','%'.$request->search.'%')
            ->orWhere('name','like','%'.$request->search.'%')
            ->orWhere('address','like','%'.$request->search.'%')
            ->orWhere('city','like','%'.$request->search.'%')
            ->get();
        return response()->json($return);
    }

    /**
     * Permet l'impression d'une fiche de travail
     *
     * @param Request $request
     */
    public function print(Request $request)
    {
        $worksheet = Worksheet::find($request->post('id'));
        $options = new MocoOptions(new MocoOptionsListWorksheetPrint());
        $options->manualHours = $request->post('mh');
        $options->hours = $request->post('h');
        $options->parts = $request->post('p');
        $pdf = new MocoWorksheet($worksheet, $options);
        $pdf->build();
        $pdf->Output();

    }

    /**
     * permet l'affichage des pièces pour une fiche de travaille
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function partConsult($id)
    {
        $worksheet = Worksheet::find($id);
        $_outs = ViewPartsSignedValues::where('worksheet_id','=',$id)->where('type','=','O')->orderBy('part_number')->get();
        $_reassorts = ViewPartsSignedValues::where('worksheet_id','=',$id)->where('type','=','R')->orderBy('part_number')->get();
        $_records = ViewPartsSignedValues::groupBy('worksheet_id','type')
            ->select('worksheet_id','type', DB::raw('sum(total_price_signed) as total'))
            ->where('worksheet_id','=',$id)->get();
        $_total = ['O' => 0, 'R' => 0];
        foreach ($_records as $_record){
            $_total[$_record->type] = $_record->total;
        }
        return view('worksheet.part-consult',[
            'worksheet' => $worksheet,
            '_outs' => $_outs,
            '_reassorts' => $_reassorts,
            '_total' => $_total,
        ]);
    }

    /**
     * Export une fiche de travail vers un fichier Excel
     *
     * @param $id
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export($id,$number)
    {
        return (new CompleteWorksheetExport($id))->download('worksheet_'.$number.'_'.date('Hidmyy',time()).'.xlsx');
    }

}
