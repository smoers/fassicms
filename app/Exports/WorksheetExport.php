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
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Moco\Common\Moco;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class WorksheetExport extends DefaultValueBinder implements FromQuery, WithHeadings, WithColumnFormatting, ShouldAutoSize, WithStyles, WithCustomValueBinder, WithStrictNullComparison, WithTitle
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
     * @param Cell $cell
     * @param mixed $value
     * @return bool
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function bindValue(Cell $cell, $value): bool
    {
        if ($cell->getWorksheet()->getTitle() === trans('Worksheet')){
            if ($cell->getColumn() == 'F' || $cell->getColumn() == 'G' || $cell->getColumn() == 'O') {
                if (is_numeric($value) && $value == 1) {
                    $cell->setValueExplicit(true, DataType::TYPE_BOOL);
                    return true;
                } elseif (is_numeric($value) && ($value == 0)) {
                    $cell->setValueExplicit(False, DataType::TYPE_BOOL);
                    return true;
                }
            } elseif ($cell->getColumn() == 'N' && $cell->getRow() > 1){
                $cell->setValueExplicit(Moco::floatValReplace($value),DataType::TYPE_NUMERIC);
                return true;
            }
        }
        return parent::bindValue($cell, $value); // TODO: Change the autogenerated stub
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
}
