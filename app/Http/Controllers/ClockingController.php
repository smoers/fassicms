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
 *  Date : 6/02/21 09:22
 */

namespace App\Http\Controllers;

use App\Moco\Common\Moco;
use App\Models\Clocking;
use App\Models\ClockingsDetails;
use App\Models\Technician;
use App\Models\ViewClockingsDetailsCorrect;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Worksheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClockingController extends Controller
{

    private $action = null;
    private $status = null;
    /**
     * ClockingController constructor.
     */
    public function __construct()
    {
        $this->action = config('moco.clocking.actions');
        $this->status = config('moco.clocking.status');
    }


    /**
     * Edition et ajout de prestations sur une fiche de travail
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $worksheet = Worksheet::find($id);
        return view('worksheet.clocking-form',[
            'action' => route('clocking.update',$id),
            'technicians' => Technician::all()->sortBy('lastname'),
            'worksheet' => $worksheet,
            'clockings' => $worksheet->clockings,
        ]);
    }

    /**
     * Ouvre le formulaire avec la liste des pointages jour-1 non cloturés
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function correct()
    {
        $clockings = ViewClockingsDetailsCorrect::where('status','=',$this->status['activated'])->get();
        return view('worksheet.clockings-details-correct-list',[
            'clockings' => $clockings,
        ]);
    }

    /**
     * Sauvegarde les prestations
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        /**
         * Collection des objet Clocking avant modification
         */
        $currentClockings = Clocking::where('worksheet_id','=',$id)->get();
        /**
         * Ce tableau va contenir les objet qui ont été mis à jour
         */
        $updateClockings = new Collection();
        /**
         * Tableau qui va contenir les objets Clocking a sauvegarder
         */
        $clockings = array();
        /**
         * Récupère le tableau des imputs
         */
        $input = $request->all();
        if (array_key_exists('technician_id',$input)) {
            /**
             * On parcours le tableau des valeurs récupérée
             */
            foreach ($input['technician_id'] as $key => $technician_id) {
                /**
                 * Est ce un nouvelle enregistrement ou la modification d'un existant
                 */
                if (is_null($input['id'][$key])) {
                    $clocking = new Clocking();
                } else {
                    $clocking = Clocking::find($input['id'][$key]);
                    /**
                     * L'objet Clocking ayant été mis à jour on le conserve
                     */
                    $updateClockings->push($clocking);
                }
                /**
                 * Hydrate l'objet Clocking
                 */
                $clocking->technician_id = $technician_id;
                $clocking->worksheet_id = $id;
                $clocking->setDateAttribute($input['start_date'][$key]);
                $clocking->setStartDateTime($input['start_date'][$key], $input['start_time'][$key]);
                $clocking->setStopDateTime($input['start_date'][$key], $input['stop_time'][$key]);
                $clocking->user()->associate(Auth::user());
                array_push($clockings, $clocking);
            }
            /**
             * On sauvegarde les modifications et les nouveaux records
             */
            foreach ($clockings as $clocking) {
                $clocking->save();
            }

        }
        /**
         * Récupére la collection des objets qui n'ont pas été mis à jour
         * cela signifie qu'ils doivent être supprimé
         */
        $deleteClockings = $currentClockings->diff($updateClockings);
        foreach ($deleteClockings as $deleteClocking) {
            $deleteClocking->delete();
        }

        return redirect()->route('worksheet.index')->with('success', trans('The clockings has been saved with success'));
    }

    public function show($id)
    {
        dd(Clocking::find($id)->technician);
    }

    /**
     * formulaire de pointage des techniciens
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ClockingTechnician()
    {
        return view('worksheet.clocking-technician-form');
    }

    /**
     * Répond à la requête ajax permettant de savoir si le numéro de fiche de travail
     * existe et son status de validation
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxWorksheetCheck(Request $request)
    {
        return response()->json(Moco::worksheetCheck($request));
    }

    public function ajaxTechnicianCheck(Request $request)
    {
        /**
         * Recherche le technicien
         */
        $technician = Technician::getTechnician($request->tec_number);
        /**
         * Recherche la fiche de travail
         */
        $worksheet = Worksheet::find($request->worksheet_id);
        if (!is_null($technician)){
            /**
             * contrôle s'il n'y a pas un clocking en 'action' 'T' et 'status' 'A' pour ce technicien
             * sur une autre fiche de travail
             */
            $clocking_detail = ClockingsDetails::getStartClocking($worksheet,$technician,'<>');
            if (!is_null($clocking_detail)){
                /**
                 * Si un enregistrement est trouvé on retourne une erreur
                 */
                $worksheet = Worksheet::find($clocking_detail->worksheet_id);
                $result = [
                    'checked' => false,
                    'msg' => trans("A start clocking has already initiated for a worksheet $worksheet->number.  Please stop this one before to start another." ),
                ];
            } else {
                /**
                 * Existe-t-il un enregistrement de départ
                 */
                $clocking_detail_start = ClockingsDetails::getStartClocking($worksheet, $technician);
                if (is_null($clocking_detail_start)) {
                    /**
                     * Pas d'enregistrement de départ donc on le crée
                     */
                    $clocking_detail_start = ClockingsDetails::setStartClocking($worksheet, $technician);
                    $result = [
                        'checked' => true,
                        'msg' => trans("$technician->firstname, a start clocking has been initiated at $clocking_detail_start->date_time for the worksheet : $worksheet->number"),
                    ];
                } else {
                    /**
                     * il y a un enregistrement de départ donc on crée un enregistrement de sortie
                     */
                    $clocking_detail_stop = ClockingsDetails::setStopClocking($worksheet, $technician);
                    /**
                     * Enregistrement du Clocking
                     */
                    $clocking = Clocking::setClocking($clocking_detail_start, $clocking_detail_stop);
                    $result = [
                        'checked' => true,
                        'msg' => trans("$technician->firstname, a stop clocking has been initiated at $clocking_detail_stop->date_time for the worksheet : $worksheet->number
                        </br>You have a total of ".$clocking->getDiff()),
                    ];
                }
            }
        } else {
            $result = [
                'checked' => false,
                'msg' => trans('This technician does not exist or is disabled'),
            ];
        }

        return response()->json($result);
    }

    /**
     * Enregistre une correction suite à une prestation non clôturée
     *
     * @param Request $request
     */
    public function ajaxCorrect(Request $request)
    {
        $result = [
            'status' => false,
            'msg' => null,
        ];
        /**
         * récupère l'enregistrement de début
         */
        $start = ClockingsDetails::find($request->id);
        /**
         * Fin de prestation ou suppression
         */
        if ($request->whyis == 'closed') {
            /**
             * a-t-il été trouvé ?
             */
            if (!is_null($start)) {
                /**
                 * Contrôle la validité de la valeur introduite
                 */
                if ($request->stop_time != '') {
                    $start_time = Carbon::createFromTimeString($start->getTime());
                    $stop_time = Carbon::createFromTimeString($request->stop_time);
                    /**
                     * S'assure que la valeur de fin est supérieur à la valeur de début
                     */
                    if ($start_time->lessThan($stop_time)) {
                        /**
                         * On crée l'enregistrement la fin de prestation
                         */
                        $worksheet = Worksheet::find($start->worksheet_id);
                        $technician = Technician::find($start->technician_id);
                        $stop = new ClockingsDetails();
                        $stop->date = $start->getDate();
                        $stop->setDateTime($start->getDate(), $request->stop_time);
                        $stop->action = $this->action['stop'];
                        $stop->status = $this->status['activated'];
                        $stop->worksheet()->associate($worksheet);
                        $stop->technician()->associate($technician);
                        $stop->user()->associate(Auth::user());
                        $stop->save();
                        /**
                         * On crée l'enregistrement de la prestation complète dans la table Clockings
                         */
                        $clocking = Clocking::setClocking($start, $stop);
                        $result['status'] = true;
                        $result['msg'] = trans('The stop time has been correctly saved');
                    } else {
                        $result['msg'] = trans('The stop time value is less than the start time value');
                    }
                } else {
                    $result['msg'] = trans('The time value is not correct');
                }
            }
        } elseif ($request->whyis == 'removed') {
            if (!is_null($start)){
                $start->status = $this->status['deleted'];
                $start->user()->associate(Auth::user());
                $start->save();
                $result['status'] = true;
                $result['msg'] = trans('This start clocking has been flagged as deleted');
            } else {
                $result['msg'] = trans('This start clocking cannot be flagged as deleted, see with your administrator');
            }
        }

        return response()->json($result);

    }


}
