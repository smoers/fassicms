<?php
/*
 * Copyright (c) 2020. MO Consult
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
 *  Date : 13/11/20 15:52
 */

namespace App\Http\Livewire\Store;

use App\Http\Requests\StorePartRequest;
use App\Models\Provider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Livewire\Component;

class StorePartForm extends Component
{
    public $part_number;
    public $description;
    public $qty;
    public $location;
    public $price;
    public $year;
    public $provider;
    public $enabled;

    public function updated($propertyName)
    {
        $formRequest = new StorePartRequest();
        $this->validateOnly($propertyName, $formRequest->rules(),$formRequest->messages());
    }

    public function mount()
    {
        $this->year = Carbon::now()->year;
        $this->enabled = 'Yes';
        $this->old();
    }

    public function render()
    {
        $providers = Provider::all()->sortBy('name');
        return view('livewire.store.store-part-form')->with('providers',$providers);
    }

    /**
     * Charge les champs avec les anciennes valeurs dans le cas d'un retour avec erreur
     */
    protected function old(){
        if(!is_null($oldBag = session()->get('oldBag')))
        {
            $this->part_number = $oldBag->get('part_number');
            $this->description = $oldBag->get('description');
            $this->qty = $oldBag->get('qty');
            $this->location = $oldBag->get('location');
            $this->price = $oldBag->get('price');
            $this->year = $oldBag->get('year');
            $this->provider = $oldBag->get('provider');
            $this->enabled = $oldBag->get('enabled');
            //suppression de l'objet dans la session
            session()->remove('oldBag');
        }
    }
}
