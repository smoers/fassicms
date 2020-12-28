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
    public $perPage = 15;
    public $perPageOptions = [10,15,20,25,30,35,40,45,50];
    public $loadingIndicator = true;
    public $year = null;
    public $enabled = null;
    protected $listeners = ['headerChange'];

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
                    return $this->view('menus.store-list-sub',['store' => $model]);
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

    public function render(): View
    {
        $this->setTableHeadClass("brown-lighter-hover");
        return parent::render(); // TODO: Change the autogenerated stub
    }
}
