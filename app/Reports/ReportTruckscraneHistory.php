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
 *  Date : 18/12/21 17:03
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 18-12-21
 */

namespace App\Reports;

use App\Moco\Datatables\Column;
use App\Moco\Datatables\DataTableComponent;
use App\Moco\Datatables\Filters\DateFilter;
use App\Moco\Datatables\Filters\SelectBooleanFilter;
use App\Moco\Datatables\Filters\TextFilter;
use App\Models\Truckscrane;
use Illuminate\Database\Eloquent\Builder;

class ReportTruckscraneHistory extends DataTableComponent
{

    public bool $tableIsFiltered = true;
    public string $sortField = 'serial';

    public function query(): Builder
    {
        return Truckscrane::query()->select()
            ->leftJoin('customers','customers.id','=','truckscranes.customer_id');
    }

    public function columns(): array
    {
        return [
            Column::make(trans('Serial number'),'serial')
                ->setSortable()
                ->setFilter(new TextFilter('serial')),
            Column::make(trans('Crane model'),'crane_model')
                ->setSortable()
                ->setFilter(new TextFilter('crane_model')),
            Column::make(trans('Plate number'),'plate')
                ->setSortable()
                ->setFilter(new TextFilter('plate')),
            Column::make(trans('Brand'),'brand')
                ->setSortable()
                ->setFilter(new TextFilter('brand')),
            Column::make(trans('Truck model'),'truck_model')
                ->setSortable()
                ->setFilter(new TextFilter('truck_model')),
            Column::make(trans('Current'),'current')
                ->setSortable()
                ->formatYesNo()
                ->setFilter(new SelectBooleanFilter('current')),
            Column::make(trans('Current date'),'date_current')
                ->setSortable()
                ->setFilter(new DateFilter('date_current')),
            Column::make(trans('Customer'),'name')
                ->setSortable()
                ->setFilter(new TextFilter('name')),
            Column::make(trans('Address'),'address')
                ->setFilter(new TextFilter('address')),
            Column::make(trans('City'),'city')
                ->setSortable()
                ->setFilter(new TextFilter('city')),
            Column::make(trans('Zipcode'),'zipcode')
                ->setSortable()
                ->setFilter(new TextFilter('zipcode')),
            Column::make(trans('Country'),'country')
                ->setSortable()
                ->setFilter(new TextFilter('country')),
            Column::make(trans('Black Listed'), 'black_listed')
                ->setSortable()
                ->setFilter(new SelectBooleanFilter('black_listed'))

        ];
    }

    public function setTableDataColumnClass(Column $column): ?string
    {
        $class = '';
        switch ($column->getAttribute()){
            case 'crane_model':
            case 'serial':
            case 'name':
                $class = 'moco-size-column-table-250';
                break;
            case 'plate':
            case 'current':
            case 'city':
            case 'country':
            case 'zipcode':
                $class = 'moco-size-column-table-100';
                break;
            case 'brand':
            case 'truck_model':
            case 'date_current':

                $class = 'moco-size-column-table-150';
                break;
            case 'address':
            case 'black-listed':
                $class = 'moco-size-column-table-300';
                break;
        }
        return $class;
    }
}
