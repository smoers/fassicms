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
 *  Date : 6/11/21 10:23
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 06-11-21
 */

namespace App\Moco\Datatables\Exports;

use App\Moco\Common\Moco;
use App\Moco\Datatables\Column;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExportDataTable implements FromQuery, WithHeadings, WithTitle, ShouldAutoSize, WithStrictNullComparison, WithStyles, WithColumnFormatting, WithMapping
{
    use Exportable;

    protected string $title;
    protected Builder $builder;
    protected array $columns;
    protected array $tables = [];
    protected array $fieldType = [];
    protected array $heading = [];
    protected array $columnFormats = [];
    protected array $map = [];
    protected array $typeConversion = [
        'string' => NumberFormat::FORMAT_TEXT,
        'date' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        'datetime' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        'bigint' => NumberFormat::FORMAT_NUMBER,
        'decimal' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        'boolean' => '',
    ];

    /**
     * Constructeur
     *
     * @param Builder $builder
     * @param array $columns
     * @param string $title
     */
    public function __construct(Builder $builder, array $columns, string $title = 'Default')
    {
        $this->builder = $builder;
        $this->columns = $columns;
        $this->title = $title;
        $this->retrieveTables();
        $this->load();
    }

    /**
     * Crée un tableau avec les tables intervenant dans la relation
     */
    protected function retrieveTables(): void
    {
        array_push($this->tables, $this->builder->getQuery()->from);
        foreach ($this->builder->getQuery()->joins as $join){
            array_push($this->tables, $join->table);
        }
    }

    /**
     * Charge l'objet
     */
    protected function load()
    {
        foreach ($this->columns as $column){
            $this->loadHeadings($column);
            $this->loadColumnFormats($column);
        }
    }

    /**
     * Charge l'entête de la colonne
     *
     * @param Column $column
     */
    protected function loadHeadings(Column $column)
    {
        array_push($this->heading, $column->getName());
    }

    /**
     * Charge le format de la colonne
     *
     * @param Column $column
     */
    protected function loadColumnFormats(Column $column)
    {
        $lastIndex = array_key_last($this->columnFormats);
        if (is_null($lastIndex))
            $lastIndex = 'A';
        else
            $lastIndex++;
        $this->columnFormats[$lastIndex] = $this->getFieldFormat($column);
    }

    /**
     * Retourne le type du champ
     *
     * @param Column $column
     * @return NumberFormat|null
     */
    protected function getFieldFormat(Column $column): ?string
    {
        $type = $this->getFieldType($column);
        if (array_key_exists($type, $this->typeConversion)){
            return $this->typeConversion[$type];
        }
        return '';
    }

    protected function getFieldType(Column $column): ?string
    {
        foreach ($this->tables as $table){
            if (Schema::hasTable($table)){
                if (Schema::hasColumn($table, $column->getAttribute())){
                    return Schema::getColumnType($table, $column->getAttribute());
                }
            }
        }
        return null;
    }



    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return $this->builder;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return $this->heading;
    }

    public function title(): string
    {
        return $this->title;
    }

    /**
     * Style de la ligne de titre
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

    public function columnFormats(): array
    {
        return $this->columnFormats;
    }

    public function map($row): array
    {
        $map = [];
        foreach ($this->columns as $column){
            switch ($this->getFieldType($column)){
                case 'date':
                    array_push($map,Moco::dateTimeToExcel($row[$column->getAttribute()]));
                    break;
                case 'datetime':
                    array_push($map,Moco::dateTimeToExcel($row[$column->getAttribute()],'d/m/Y H:i'));
                    break;
                case 'decimal':
                    array_push($map,Moco::floatValReplace($row[$column->getAttribute()]));
                    break;
                case 'boolean':
                    array_push($map,$row[$column->getAttribute()] === 1);
                    break;
                default:
                    array_push($map,$row[$column->getAttribute()]);
            }
        }
        return $map;
    }
}
