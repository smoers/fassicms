<?php
/*
 * Copyright (c) 2022. MO Consult
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
 *  Date : 19/01/22 20:38
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 19-01-22
 */

namespace App\Reports;

use App\Moco\Datatables\Column;
use App\Moco\Datatables\DataTableComponent;
use App\Moco\Datatables\Filters\IntNumberFilter;
use App\Moco\Datatables\Filters\SelectBooleanFilter;
use App\Moco\Datatables\Filters\TextFilter;
use App\Models\ViewPartmetadatasReassort;
use Illuminate\Database\Eloquent\Builder;

class ReportStockReassortment extends DataTableComponent
{
    /**
     * Tableau avec un filtre
     * @var bool
     */
    public bool $tableIsFiltered = true;
    /**
     * sort field part défaut
     * @var string
     */
    public string $sortField = 'part_number';

    public function query(): Builder
    {
        return ViewPartmetadatasReassort::query();
    }

    public function columns(): array
    {
        return [
            /** part_number**/
            Column::make(trans('Part Number'),'part_number')
                ->setSortable()
                ->setFilter(new TextFilter('part_number')),

            /** description **/
            Column::make(trans('Description'),'description')
                ->setSortable()
                ->setFilter(new TextFilter('description')),

            /** partmetadatas.enabled **/
            Column::make(trans('Enabled'),'enabled')
                ->format(function(ViewPartmetadatasReassort $model){
                    return $model->enabled == 1 ? trans('Yes') : trans('No');
                })
                ->setFilter(new SelectBooleanFilter('partmetadatas.enabled', 2)),

            /** electrical_part **/
            Column::make(trans('Electrical Part'),'electrical_part')
                ->format(function(ViewPartmetadatasReassort $model){
                    return $model->electrical_part == 1 ? trans('Yes') : trans('No');
                })
                ->setFilter(new selectBooleanFilter('electrical_part')),

            /** bar_code **/
            Column::make(trans('BarCode'),'bar_code')
                ->setSortable()
                ->setFilter(new TextFilter('bar_code')),

            /** reassort_level **/
            Column::make(trans('Reassort Level'), 'reassort_level')
                ->setSortable()
                ->format(function (ViewPartmetadatasReassort $model){
                    return number_format($model->reassort_level,0,',','.');
                })
                ->setFilter(new IntNumberFilter('reassort_level')),

            /** qty **/
            Column::make(trans('Quantity'), 'qty')
                ->setSortable()
                ->setFilter(new IntNumberFilter('qty')),

        ];
    }

    /**
     * @param Column $column
     * @return string|null
     */
    public function setTableHeadColumnClass(Column $column): ?string
    {
        $class = '';
        switch ($column->getAttribute()){
            case 'part_number' :
                $class = 'moco-size-column-table-250';
                break;
            case 'description':
                $class = 'moco-size-column-table-300';
                break;
            case 'enabled':
                $class = 'moco-size-column-table-100';
                break;
            case 'electrical_part':
            case 'barcode':
                $class = 'moco-size-column-table-150';
                break;
            case 'qty':
            case 'reassort_level':
                $class = 'moco-size-column-table-200';
                break;
        }

        return $class;
    }

    /**
     * @param Column $column
     * @return string|null
     */
    public function setTableDataColumnClass(Column $column): ?string
    {
        $class = '';
        switch ($column->getAttribute()){
            case 'qty':
            case 'reassort_level':
                $class = 'text-right';
                break;
        }

        return $class;
    }

}
