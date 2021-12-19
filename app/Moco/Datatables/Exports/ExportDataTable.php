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

use App\Moco\Datatables\Column;
use Doctrine\DBAL\Schema\Schema;
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
    protected array $typeConversion = [
        'string' => NumberFormat::FORMAT_GENERAL,
        'date' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        'datetime' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        'bigint' => NumberFormat::FORMAT_NUMBER,
        'decimal' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1
    ];

    /**
     * Constructeur
     *
     * @param Builder $builder
     * @param array $column
     */
    public function __construct(Builder $builder, array $columns)
    {
        $this->builder = $builder;
        $this->columns = $columns;
        $this->retrieveTables();
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

    protected function build()
    {
        foreach ($this->columns as $column){
            $this->buildHeadings($column);
        }
    }

    protected function buildHeadings(Column $column)
    {
        array_push($this->heading, $column->getName());
    }

    protected function buildColumnFormats()
    {

    }

    /**
     * Retourne le type du champ
     *
     * @param Column $column
     * @return NumberFormat|null
     */
    protected function getFieldType(Column $column): ?NumberFormat
    {
        foreach ($this->tables as $table){
            if (Schema::hasTable($table)){
                if (Schema::hasColumn($table, $column->getAttribute())){
                    $type = Schema::getColumnType($table, $column->getAttribute());
                    if (array_key_exists($this->typeConversion)){
                        return $this->typeConversion[$type];
                    }
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
        // TODO: Implement map() method.
    }
}
