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
 *  Date : 19/12/21 15:40
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 19-12-21
 */

namespace App\Moco\Datatables\Traits;

use App\Moco\Datatables\Exports\ExportDataTable;
use Illuminate\Support\Facades\Storage;

trait Export
{
    /**
     * un export est encours de génération
     * @var bool
     */
    public $exporting = false;
    /**
     * Le nom du fichier
     * @var null
     */
    public $name = null;

    /**
     * Export les données le query builder
     */
    public function export()
    {
        /**
         * Démarre un exeport
         */
        $this->exporting = true;
        $export = new ExportDataTable($this->models(), $this->columns());
        $this->name = str_replace(' ','_',$this->title).'_'.date('Hidmyy',time()).'.xlsx';
        $export->store($this->name,'public');
    }

    /**
     * download le fichier généré
     * @return mixed
     */
    public function downloadExport()
    {
        $this->exporting = false;
        return Storage::download('public/'.$this->name);
    }
}
