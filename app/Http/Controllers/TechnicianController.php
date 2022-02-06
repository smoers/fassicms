<?php

namespace App\Http\Controllers;

use App\Http\Requests\TechnicianRequest;
use App\Moco\Common\Moco;
use App\Moco\Common\MocoAjaxValidation;
use App\Moco\Common\MocoModelForConsult;
use App\Moco\Common\MocoOptions;
use App\Moco\Common\MocoOptionsTechnicianPrintList;
use App\Moco\Printer\MocoTechniciansListCodebar;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianController extends Controller
{
    use MocoAjaxValidation;

    /**
     * TechnicianController constructor.
     */
    public function __construct()
    {
        $this->formRequest = new TechnicianRequest();
    }


    /**
     * charge la liste des techniciens
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('technician.technician-list');
    }

    /**
     * permet la création d'un nouveaux technicien
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function create()
    {
        $technician = new Technician();
        $technician->number = Moco::technicianNumber();
        $technician->enabled = true;
        return view('technician.technician',[
            'action' => route('technician.store'),
            'title' => trans('Add technician'),
            'technician' => $technician
        ]);
    }

    /**
     * Enregistre un nouveau trechnicien
     *
     * @param TechnicianRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TechnicianRequest $request)
    {
        $validated = $request->validated();
        $technician = new Technician();
        $technician->number = $validated['number'];
        $technician->lastname = $validated['lastname'];
        $technician->firstname = $validated['firstname'];
        $technician->enabled = $validated['enabled'];
        $technician->user()->associate(Auth::user());
        $technician->save();

        return redirect()->route('technician.index')->with('success', trans('The technician has been saved !'));

    }

    /**
     * Formulaire de modification d'un technicien
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $technician = Technician::find($id);
        return view('technician.technician',[
            'action' => route('technician.update',$id),
            'title' => trans('Modify technician'),
            'technician' => $technician
        ]);
    }

    /**
     * Enregistre les modifications apportées à un technicien
     *
     * @param TechnicianRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TechnicianRequest $request, $id)
    {
        $validated = $request->validated();
        $technician = Technician::find($id);
        $technician->lastname = $validated['lastname'];
        $technician->firstname = $validated['firstname'];
        $technician->enabled = $validated['enabled'];
        $technician->user()->associate(Auth::user());
        $technician->save();

        return redirect()->route('technician.index')->with('success', trans('The technician has been saved !'));
    }

    /**
     * Check si un technicien existe avec le même nom et prénom
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxNameCheck(Request $request)
    {
        $result=[
            'checked' => false,
            'msg' => '',
        ];
        $technician = Technician::where('lastname','=',$request->lastname)->where('firstname','=',$request->firstname)->first();
        if (!is_null($technician)){
            $result = [
                'checked' => true,
                'msg' => trans('A technician with this lastname and firstname already exist. You can continue so, the system authorize two technicians with the same name.')
            ];
        }
        return response()->json($result);
    }

    public function show($id)
    {
        $technician = Technician::find($id);
        if (!is_null($technician)){
            $mocoModelForConsult = new MocoModelForConsult($technician,Auth::user()->can('consult technician extended'));
            return view('consult.consult',
                [
                    'title' => trans('Consult Customer'),
                    'consult' => $mocoModelForConsult->getBladeLayout(),
                    'return' => route('technician.index'),
                ]);
        }
        return redirect()->route('technicien.index');
    }

    public function printList()
    {
        if(!is_null($technicians = Technician::query()->where('enabled','=',true)->get())){
            $options = new MocoOptions(new MocoOptionsTechnicianPrintList());
            $pdf = new MocoTechniciansListCodebar($technicians, $options);
            $pdf->build();
            $pdf->Output();
        }

    }
}
