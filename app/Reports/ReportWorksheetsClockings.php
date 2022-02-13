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
 *  Date : 5/02/22 14:08
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 05-02-22
 */

namespace App\Reports;

use App\Moco\Datatables\Column;
use App\Moco\Datatables\DataTableComponent;
use App\Moco\Datatables\DataTableQueryBuilder;
use App\Moco\Datatables\Filters\DateFilter;
use App\Moco\Datatables\Filters\SelectBooleanFilter;
use App\Moco\Datatables\Filters\TextFilter;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ReportWorksheetsClockings extends DataTableComponent
{
    public string $sortField = 'worksheets.number';
    public bool $tableIsFiltered = true;

    public function query(): Builder
    {
        return DataTableQueryBuilder::make('worksheets','clockings','technicians')->builder()->leftJoin('clockings','worksheets.id','=','clockings.worksheet_id')->leftJoin('technicians','technicians.id','=','clockings.technician_id')->where('truckscrane_id','<>',null);
    }

    public function columns(): array
    {
        return [
            /*** Worksheet Number ***/
            Column::make(trans('Number'),'worksheets.number')
                ->setSortable()
                ->setFilter(new TextFilter('worksheets.number')),

            /*** Date ***/
            Column::make(trans('Date'),'worksheets.date')
                ->setSortable()
                ->formatDate()
                ->setFilter(new DateFilter('worksheets.date')),

            /*** Technician number ***/
            Column::make(trans('Technician number'),'technicians.number')
                ->setSortable()
                ->setFilter(new TextFilter('technicians.number')),

            /*** Technicien Firstname ***/
            Column::make(trans('Firstname'),'technicians.firstname')
                ->setSortable()
                ->setFilter(new TextFilter('technicians.firstname')),

            /*** Technicien Lastname ***/
            Column::make(trans('Lastname'),'technicians.lastname')
                ->setSortable()
                ->setFilter(new TextFilter('technicians.lastname')),

            /*** Technicians Enabled ***/
            Column::make(trans('Enabled'),'technicians.enabled')
                ->formatYesNo()
                ->setFilter(new SelectBooleanFilter('technicians.enabled')),

            /*** Clocking Date ***/
            Column::make(trans('Clocking date'),'clockings.date')
                ->setSortable()
                ->formatDate()
                ->setFilter(new DateFilter('clockings.date')),

            /*** Clocking Start_date ***/
            Column::make(trans('Clocking start'),'clockings.start_date')
                ->format(function (Worksheet $model, Column $column){
                    return !is_null($model[$column->getAlias()]) ? Carbon::parse($model[$column->getAlias()])->format('H:i') : null;
                }),

            /*** Clocking Stop_date ***/
            Column::make(trans('Clocking stop'),'clockings.stop_date')
                ->format(function (Worksheet $model, Column $column){
                    return !is_null($model[$column->getAlias()]) ? Carbon::parse($model[$column->getAlias()])->format('H:i') : null;
                }),

            /*** Hours ***/
            Column::make(trans('Clocking hours'))
                ->format(function (Worksheet $model, Column $column){
                    $start = Carbon::parse($model[DataTableQueryBuilder::alias('clockings.start_date')]);
                    $stop = Carbon::parse($model[DataTableQueryBuilder::alias('clockings.stop_date')]);
                    return $start->diff($stop)->format('%H:%I');
                }),
        ];
    }

}
