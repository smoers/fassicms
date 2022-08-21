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
use App\Models\Truckscrane;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public ?Truckscrane $truckscrane = null;
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
        'eventDatePickerChange' => 'eventDatePickerChange',
    ];
    /**
     * form request pour la validation des champs
     * @var
     */
    protected $formRequest;

    public int $validated;
    public int $warranty;
    public int $oil_filtered;
    public $validated_date;

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
        $this->validated = $this->worksheet->validated;
        $this->warranty = $this->worksheet->warranty;
        $this->oil_filtered = $this->worksheet->oil_filtered;
        $this->validated_date = $this->worksheet->validated_date;
        #dd($this->worksheet->validated);
        $this->truckscrane = $this->worksheet->truckscrane()->get()->first();
        if (!is_null($this->truckscrane)){
            $this->customer = Customer::find($this->truckscrane->customer_id);
        }

    }

    /**
     * Validation en temps réél
     *
     * @param $propertyName
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($propertyName)
    {
        /**
         * Permet de correctement placer la valeur des champs warranty & oil_replace
         * suite à la valeur retournée par le select
         */
        if ($propertyName === 'warranty')
            $this->worksheet->warranty = $this->warranty;
        if ($propertyName === 'oil_filtered')
            $this->worksheet->oil_filtered = $this->oil_filtered;
        if ($propertyName === 'validated') {
            $this->worksheet->validated = $this->validated;
            if ($this->worksheet->validated){
                $this->worksheet->validated_date = Carbon::now()->format('d/m/Y');
                $this->validated_date = $this->worksheet->validated_date;
            } else {
                $this->worksheet->validated_date = null;
                $this->validated_date = null;
            }
            #dd($this->worksheet);

        }
        /**
         * Validation
         */
        $this->validateOnly(
            $propertyName,
            $this->formRequest->rules(),
            $this->formRequest->messages(),
            $this->formRequest->attributes()
        );
    }

    /**
     * Sauvegarde des données
     */
    public function save(){

        /**
         * Validation
         */
        $this->validate(
            $this->formRequest->rules(),
            $this->formRequest->messages(),
            $this->formRequest->attributes()
        );
        /**
         * Sauvegarde
         */
        $this->worksheet->user()->associate(Auth::user());
        $this->worksheet->save();
        session()->flash('success',trans('The worksheet has been saved'));
        return redirect()->route('worksheet.index');
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
            $result = Truckscrane::query()
                ->select()
                ->addSelect('truckscranes.id AS tc_id')
                ->leftJoin('customers','customers.id','=','truckscranes.customer_id')
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
     * Cleanup lorsque le champ search perd le focus
     */
    public function eventSearchCraneFocusOut()
    {
        $this->searchCrane = '';
    }

    public function eventDatePickerChange($date)
    {
        $this->worksheet->date = $date;
    }

    /**
     * Un objet TrucksCrane a été choisi
     *
     * @param $id
     */
    public function getTruckCrane($id)
    {
        $this->truckscrane = Truckscrane::find($id);
        $this->customer = Customer::find($this->truckscrane->customer_id);
        $this->worksheet->truckscrane()->associate($this->truckscrane);
        $this->worksheet->truckscrane_id = $this->truckscrane->id;
    }

    /**
     *  Suppression de l'objet TrucksCrane sélectionné
     */
    public function removeTruckCrane()
    {
        $this->truckscrane = null;
        $this->customer = null;
        $this->worksheet->truckscrane()->dissociate();
        $this->worksheet->truckscrane_id = null;
    }

    public function addTrucksCrane()
    {
        session()->put('worksheet_form',$this->worksheet);
        return redirect()->route('crane.create');

    }

}
