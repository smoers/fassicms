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
 *  Date : 19/10/21 16:49
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 19-10-21
 */

namespace App\Exports;

use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Moco\Common\Moco;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class WorksheetExport implements FromQuery, WithHeadings, WithColumnFormatting, ShouldAutoSize, WithStyles, WithStrictNullComparison, WithTitle, WithMapping
{
    use Exportable;
    private $id;

    /**
     * Constructeur
     *
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Réquête vers la DB
     *
     * @return \Illuminate\Database\Eloquent\Builder|Builder
     */
    public function query()
    {
        return Worksheet::query()->whereKey($this->id);
    }

    /**
     * Titre des colonnes
     *
     * @return array
     */
    public function headings(): array
    {

        return Moco::translateArrayValue(config('moco.consult.fields.worksheets.name'));
    }

    /**
     * Format des colonnes
     *
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'L' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'N' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1
        ];
    }

    /**
     * STyle de la ligne de titre
     *
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
     * @return \bool[][][]
     */
    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'italic' => true]],
        ];
    }

    /**
     * Défini le titre de la sheet
     *
     * @return string
     */
    public function title(): string
    {
        return trans('Worksheet');
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->number,
            Moco::dateTimeToExcel($row->date),
            $row->remarks,
            $row->work,
            $row->oil_filtered === 1,
            $row->validated === 1,
            Moco::dateTimeToExcel($row->validated_date),
            $row->customer_id,
            $row->crane_id,
            Moco::dateTimeToExcel($row->created_at,'d/m/Y H:i'),
            Moco::dateTimeToExcel($row->updated_at, 'd/m/Y H:i'),
            $row->user_id,
            Moco::floatValReplace($row->oil_replace),
            $row->warranty === 1,
        ];

    }
}
