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
 *  Date : 19/12/21 10:46
 */

namespace App\Reports;

use App\Models\Partmetadata;
use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ReportingWorksheetsClockings extends Component
{

    use WithPagination;

    protected $pageBy = 10;
    protected $paginationTheme = 'bootstrap';

    public function query()
    {
        return DB::table('partmetadatas')->leftJoin('catalogs','partmetadatas.id','=','catalogs.partmetadata_id');

    }

    public function render()
    {
        return view('livewire.reporting.reporting-worksheets-clockings',[
            'worksheets' => $this->query()->paginate($this->pageBy),
            'heads' => $this->getHead(),
        ]);
    }

    public function getHead(): array
    {
        return [
            'partmetadatas' => config('moco.consult.fields.partmetadatas.name'),
            'catalogs' =>  config('moco.consult.fields.catalogs.name')
        ];
    }

    protected function getData()
    {

    }
}
