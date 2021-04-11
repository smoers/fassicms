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
 *  Date : 4/01/21 17:56
 */

namespace App\Http\Livewire\Worksheet;

use App\Models\ViewWorksheetCustomerCrane;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class WorksheetList extends TableComponent
{
    use HtmlComponents;
    protected $rowClass ='';
    public $year = null;
    public $template = false;
    public $validate = false;
    protected $listeners = ['headerChange'];

    /**
     * Configuration par défaut
     */
    public function mount()
    {
        $this->year = Carbon::now()->year;
        $this->template = false;
    }

    /**
     * CraneList constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->perPage = config('moco.table.perPage');
        $this->perPageOptions = config('moco.table.perPageOptions');
        $this->rowClass =  config('moco.table.rowClass');
        $this->loadingIndicator =true;
        $this->sortField = 'number';
        $this->sortDefaultIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->ascSortIcon = '<i class="fas fa-sort-alpha-up"></i>';
        $this->descSortIcon = '<i class="fas fa-sort-alpha-down"></i>';
        parent::__construct($id);
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $year = $this->template ? null : $this->year;
        $builder = ViewWorksheetCustomerCrane::select()->where('year','=',$year);
        if ($this->validate)
            $builder = $builder->where('validated','=',true);
        return $builder;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(trans('Number'),'number')
                ->searchable()
                ->sortable(),
            Column::make(trans('Date'), 'date')
                ->searchable()
                ->sortable()
                ->format(function (ViewWorksheetCustomerCrane $model){
                    return !is_null($model->date) ? Carbon::createFromFormat('d/m/Y', $model->date)->format('d/m/Y') : '';
                }),
            Column::make(trans('Customer name'),'name')
                ->searchable()
                ->sortable(),
            Column::make(trans('Crane serial'),'serial')
                ->searchable()
                ->sortable(),
            Column::make(trans('Actions'),'actions')
                ->format(function (ViewWorksheetCustomerCrane $model){
                    return view('menus.list-submenu',['whatIs' => 'worksheet', 'worksheet' => $model]);
                }),
        ];
    }

    /**
     * @param $attribute
     * @return string|null
     */
    public function setTableHeadClass($attribute): ?string
    {
        $extend = ' ';
        if($attribute == 'actions'){
            $extend .=  'moco-size-column-table-400';
        }
        return 'moco-title-table'.$extend;
    }

    /**
     * @param $attribute
     * @param $value
     * @return string|null
     */
    public function setTableDataClass($attribute, $value): ?string
    {
        return $this->rowClass;
    }

    /**
     * Highlight la ligne si la fiche de travail est validée
     *
     * @param $model
     * @return string|null
     */
    public function setTableRowClass($model): ?string
    {
        return $model->validated ? 'moco-row-highlight-table':'';
    }

    /**
     * Event déclenché par une modification dans le header
     *
     * @param $year
     * @param $template
     */
    public function headerChange($year,$template,$validate)
    {
        $this->year = $year;
        $this->template = $template;
        $this->validate = $validate;
    }

}
