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
 *  Date : 21/10/21 18:02
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 21-10-21
 */

namespace App\Exports;

use App\Moco\Common\Moco;
use App\Models\ViewPartsTotal;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class WorksheetPartExport implements FromQuery, WithHeadings, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;
    private $worksheetId;

    /**
     * @param $worksheetId
     */
    public function __construct($worksheetId)
    {
        $this->worksheetId = $worksheetId;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Builder|Builder
     */
    public function query()
    {
        return ViewPartsTotal::query()->where('worksheet_id', $this->worksheetId)->orderBy('part_number');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return Moco::translateArrayValue(config('moco.consult.fields.viewparttotal.name'));
    }

    /**
     * @param Worksheet $sheet
     * @return \bool[][][]
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'italic' => true]],
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return trans('Part Number');
    }
}
