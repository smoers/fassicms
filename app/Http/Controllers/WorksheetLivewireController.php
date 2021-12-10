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
 *  Date : 10/12/21 12:41
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 10-12-21
 */

namespace App\Http\Controllers;

use App\Http\Requests\WorksheetRequest;
use App\Models\Customer;
use App\Models\TrucksCrane;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class WorksheetLivewireController extends Component
{
    /**
     * valeur de recherche de la grue
     * @var string
     */
    public string $searchCrane = '';
    /**
     * Modèle Worksheet
     * @var Worksheet|null
     */
    public ?Worksheet $worksheet = null;
    /**
     * Modèle TrucksCrane
     * @var TrucksCrane|null
     */
    public ?TrucksCrane $trucksCrane = null;
    /**
     * Modèle Customer
     * @var Customer|null
     */
    public ?Customer $customer = null;
    /**
     * Tab général actif ou non
     * @var bool
     */
    public bool $tab_general;
    /**
     * Tab data actif ou non
     * @var bool
     */
    public bool $tab_data;
    /**
     * Définition des listeners
     * @var string[]
     */
    protected $listeners = [
        'eventSearchCraneFocusOut' => 'eventSearchCraneFocusOut',
    ];
    /**
     * form request pour la validation des champs
     * @var
     */
    protected $formRequest;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->formRequest = new WorksheetRequest();
        $this->rules = $this->formRequest->rules();
    }

    /**
     * montage
     */
    public function mount()
    {
        $this->tab_general = true;
        $this->tab_data = false;
    }

    /**
     * Affichage de la vue
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render(Request $request)
    {

        return view('worksheet.worksheet-livewire',
            [
                'search' => $this->search(),
            ]);
    }

    /**
     * Modifie le status des Tab suivant l'event click
     */
    public function setTab()
    {
        $this->tab_general = !$this->tab_general;
        $this->tab_data = !$this->tab_data;
    }

    /**
     * Résultat de la recherche d'une grue
     *
     * @return array|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    protected function search()
    {
        $result = [];
        $searchCrane = $this->searchCrane;
        if ($this->searchCrane !== ''){
            $result = TrucksCrane::query()
                ->select()
                ->addSelect('trucks_cranes.id AS tc_id')
                ->leftJoin('customers','customers.id','=','trucks_cranes.customer_id')
                ->where('current','=',true)
                ->where(function($query) use ($searchCrane)  {
                    $query->orwhere('serial', 'like', '%' . $searchCrane . '%')
                        ->orWhere('plate', 'like', '%' . $searchCrane . '%')
                        ->orWhere('crane_model', 'like', '%' . $searchCrane . '%')
                        ->orWhere('brand', 'like', '%' . $searchCrane . '%')
                        ->orWhere('name', 'like', '%' . $searchCrane . '%')
                        ->orWhere('address', 'like', '%' . $searchCrane . '%')
                        ->orWhere('city', 'like', '%' . $searchCrane . '%');
                        })
                ->get();
        }
        return $result;
    }

    /**
     * Celanup lorsque le champ search perd le focus
     */
    public function eventSearchCraneFocusOut()
    {
        $this->searchCrane = '';
    }

    /**
     * Un objet TrucksCrane a été choisi
     *
     * @param $id
     */
    public function getTruckCrane($id)
    {
        $this->trucksCrane = TrucksCrane::find($id);
        $this->customer = Customer::find($this->trucksCrane->customer_id);
    }

    /**
     *  Suppression de l'objet TrucksCrane sélectionné
     */
    public function removeTruckCrane()
    {
        $this->trucksCrane = null;
        $this->customer = null;
    }


}
