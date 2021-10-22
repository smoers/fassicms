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
 *  Date : 20/10/21 21:25
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 20-10-21
 */

namespace App\Exports;

use App\Models\Worksheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * Export une fiche de travail avec toutes les informations
 */
class CompleteWorksheetExport implements WithMultipleSheets
{
    use Exportable;
    private $id;

    /**
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Création des sheets du document
     *
     * @return array
     */
    public function sheets(): array
    {
        $worksheet = Worksheet::query()->find($this->id);
        return [
            new WorksheetExport($this->id),
            new CraneExport($worksheet->crane->id),
            new CustomerExport($worksheet->customer->id),
            new WorksheetPartExport($this->id),
            new WorksheetClockingExport($this->id),
        ];
    }
}
