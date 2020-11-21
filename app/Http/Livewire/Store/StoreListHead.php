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
 *  Date : 21/11/20 16:14
 */

namespace App\Http\Livewire\Store;

use Carbon\Carbon;
use Livewire\Component;

class StoreListHead extends Component
{
    public $year = null;
    public $enabled = null;

    public function mount()
    {
        $this->year = Carbon::now()->year;
        $this->enabled = true;
    }

    public function render()
    {
        if ($this->year >= 2000 and $this->year <= 2100)
        {
            $this->emit('headerChange',$this->year, $this->enabled);
        }
        return view('livewire.store.store-list-head');
    }
}
