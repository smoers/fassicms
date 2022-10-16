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

use App\Moco\Datatables\Column;
use App\Moco\Datatables\ColumnInterface;
use App\Moco\Datatables\DataTableComponent;
use App\Moco\Datatables\Filters\FloatNumberFilter;
use App\Moco\Datatables\Filters\IntNumberFilter;
use App\Moco\Datatables\Filters\SelectBooleanFilter;
use App\Moco\Datatables\Filters\TextFilter;
use App\Models\Partmetadata;
use Illuminate\Database\Eloquent\Builder;

class PartmetadataExportDataTable extends DataTableComponent
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
        return Partmetadata::query()->select()->addSelect('providers.enabled AS providers_enabled')
            ->leftJoin('catalogs','partmetadatas.id','=','catalogs.partmetadata_id')
            ->leftJoin('providers','providers.id','=','catalogs.provider_id');
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
                ->format(function(Partmetadata $model){
                    return $model->enabled == 1 ? trans('Yes') : trans('No');
                })
                ->setFilter(new SelectBooleanFilter('partmetadatas.enabled', 2)),

            /** electrical_part **/
            Column::make(trans('Electrical Part'),'electrical_part')
                ->format(function(Partmetadata $model){
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
                ->format(function (Partmetadata $model){
                    return number_format($model->reassort_level,0,',','.');
                })
                ->setFilter(new IntNumberFilter('reassort_level')),

            /** price **/
            Column::make(trans('Price'),'price')
                ->setSortable()
                ->format(function(Partmetadata $model){
                    return number_format($model->price,2,',','.');
                })
                ->setFilter(new FloatNumberFilter('price')),

            /** year **/
            Column::make(trans('Year'),'year')
                ->setSortable()
                ->setFilter(new IntNumberFilter('year')),

            Column::make(trans('Enabled'),'providers_enabled')
                ->format(function(Partmetadata $model){
                    return $model->providers_enabled == 1 ? trans('Yes') : trans('No');
                })
                ->setFilter(new SelectBooleanFilter('providers_enabled')),
            Column::make(trans('Provider'), 'name')
                ->setSortable()
                ->setFilter(new TextFilter('name')),
        ];
    }

    /**
     * @param Column $column
     * @return string|null
     */
    public function setTableHeadColumnClass(ColumnInterface $column): ?string
    {
        $class = '';
        switch ($column->getAttribute()){
            case 'part_number' :
                $class = 'moco-size-column-table-250';
                break;
            case 'name':
            case 'description':
                $class = 'moco-size-column-table-300';
                break;
            case 'enabled':
                $class = 'moco-size-column-table-100';
                break;
            case 'electrical_part':
            case 'year':
            case 'price':
            case 'barcode':
                $class = 'moco-size-column-table-150';
                break;
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
    public function setTableDataColumnClass(ColumnInterface $column): ?string
    {
        $class = '';
        switch ($column->getAttribute()){
            case 'reassort_level':
            case 'year':
            case 'price' :
                $class = 'text-right';
                break;
        }

        return $class;
    }
}
