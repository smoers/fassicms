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
 *  Date : 11/11/20 11:53
 */

namespace App\Http\Livewire;

use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class StoreList extends TableComponent
{
    use HtmlComponents;
    public $perPage = 15;
    public $perPageOptions = [10,15,20,25,30,35,40,45,50];
    public $loadingIndicator = true;
    public $year = 2020;


    /**
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $year = Carbon::now()->year;
        return Store::with('catalogs')
            ->select('stores.*','catalogs.price')
            ->leftJoin('catalogs','stores.id','=','catalogs.store_id')
            ->where('catalogs.year','=',$year);
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
            Column::make(trans('Price'),'price')
                ->format(function (Store $model){
                    return $this->html('<div class="text-right w-100 ">'.number_format($model->price,2,',','.').'</div>');
                }),
            Column::make(trans('Actions'))
                ->format(function (Store $model){
                    return view('menus.store-list-sub');
                }),

        ];
    }
}
