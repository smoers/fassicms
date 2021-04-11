<?php
/*
 * Copyright (c) 2020. MO Consult
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
 *  Date : 21/11/20 16:07
 */

/**
 * package https://github.com/rappasoft/laravel-livewire-tables
 */

namespace App\Http\Livewire\Store;


use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\View\View;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class StoreList extends TableComponent
{
    use HtmlComponents;
    public $year = null;
    public $enabled = null;
    protected $listeners = ['headerChange'];

    /**
     * CraneList constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->perPage = config('moco.table.perPage');
        $this->perPageOptions = config('moco.table.perPageOptions');
        $this->rowClass =  config('moco.table.rowClass');
        $this->loadingIndicator = true;
        $this->sortField = 'part_number';
        $this->sortDefaultIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->ascSortIcon = '<i class="fas fa-sort-alpha-up"></i>';
        $this->descSortIcon = '<i class="fas fa-sort-alpha-down"></i>';
        parent::__construct($id);
    }

    /**
     *
     */
    public function mount()
    {
        $this->year = Carbon::now()->year;
        $this->enabled = true;
    }

    /**
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return Store::with('catalogs')
            ->select('stores.*','catalogs.id as cat_id','catalogs.price','catalogs.year')
            ->leftJoin('catalogs','stores.id','=','catalogs.store_id')
            ->where('catalogs.year','=',$this->year)
            ->where('stores.enabled','=', $this->enabled);
    }

    /**
     * @return array
     */
    public function columns(): array
    {

        return [
            Column::make(trans('Part Number'), 'part_number')
                ->searchable()
                ->sortable(),
            Column::make(trans('Description'),'description')
                ->searchable()
                ->sortable(),
            Column::make(trans('Quantity'), 'qty')
                ->format(function (Store $model){
                    return $this->html('<div class="text-right w-100 ">'.$model->qty.'</div>');
                }),
            Column::make(trans('Price')." $this->year",'price')
                ->format(function (Store $model){
                    return $this->html('<div class="text-right w-100 ">'.number_format($model->price,2,',','.').'</div>');
                }),
            Column::make(trans('Actions'))
                ->format(function (Store $model){
                    return view('menus.store-list-sub',['store' => $model]);
                }),

        ];
    }

    /**
     * @param $year
     * @param $enabled
     */
    public function headerChange($year,$enabled)
    {
        $this->year = $year;
        $this->enabled = $enabled;
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
}
