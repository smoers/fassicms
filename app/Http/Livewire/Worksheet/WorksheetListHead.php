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
 *  Date : 3/01/21 17:35
 */

namespace App\Http\Livewire\Worksheet;

use App\Moco\Common\MocoLivewireSearchSession;
use Carbon\Carbon;
use Livewire\Component;

class WorksheetListHead extends Component
{
    use MocoLivewireSearchSession;

    /**
     * propriété utilisée par le trait MocoLivewireSearchSession
     * @var array|string[]
     */
    protected array $properties =  ['year','template','validate'];

    public $year = null;
    public $template = false;
    public $validate = false;

    public function mount()
    {
        $this->loadSearchSessionValue();
    }

    /**
     *
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        if (is_null($this->year) || ($this->year < 2000 and $this->year > 2100)){
            $this->year = Carbon::now()->year;
        }
        $this->emit('headerChange',$this->year, $this->template,$this->validate);
        return view('livewire.worksheet.worksheet-list-head');
    }


}
