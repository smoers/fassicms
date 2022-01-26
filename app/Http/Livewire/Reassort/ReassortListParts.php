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
 *  Date : 22/11/20 12:58
 */

namespace App\Http\Livewire\Reassort;

use App\Moco\Common\MocoLivewireSearchSession;
use App\Models\Partmetadata;
use App\Models\Store;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ReassortListParts extends TableComponent
{
    use HtmlComponents, MocoLivewireSearchSession;

    /**
     * propriété utilisée par le trait MocoLivewireSearchSession
     * @var array|string[]
     */
    protected array $properties =  ['locationId'];
    public $locationId = null;
    protected $listeners = ['headerChange'];

    /**
     * ReassortListParts constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->perPage = config('moco.table.perPage');
        $this->perPageOptions = config('moco.table.perPageOptions');
        $this->rowClass =  config('moco.table.rowClass');
        $this->loadingIndicator =true;
        $this->sortField = 'part_number';
        $this->sortDefaultIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->ascSortIcon = '<i class="fas fa-sort-alpha-up"></i>';
        $this->descSortIcon = '<i class="fas fa-sort-alpha-down"></i>';
        parent::__construct($id);
    }

    /**
     * Charger lors de la création de l'objet
     *
     */
    public function mount()
    {
        $this->locationId = config('moco.reassort.defaultLocation');
        $this->loadSearchSessionValue();
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Partmetadata::with('stores')
            ->select('partmetadatas.*','stores.id as store_id','stores.qty as qty','locations.id as loc_id','locations.location as location')
            ->leftJoin('stores','partmetadatas.id','=','stores.partmetadata_id')
            ->leftJoin('locations','locations.id','=','stores.location_id')
            ->where('partmetadatas.enabled','=',true)
            ->where('locations.id','=', $this->locationId);
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
                ->format(function (Partmetadata $model){
                    return $this->html('<div class="text-right w-100 ">'.$model->qty.'</div>');
                }),
            Column::make(trans('Location'), 'location'),
            Column::make(trans('Actions'))
                ->format(function (Partmetadata $model){
                    return view('menus.store-list-sub',['partmetadata' => $model]);
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
        switch ($attribute) {
            case 'actions':
                $extend .=  'moco-size-column-table-400';
                break;
            case 'part_number':
                $extend .= 'moco-size-column-table-150';
                break;
            case 'qty':
                $extend .= 'moco-size-column-table-100';
                break;
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
     * Event déclenché par un changement dans l'entête
     *
     * @param $locationId
     */
    public function headerChange($locationId)
    {
        $this->locationId = $locationId;
        /**
         * nécessaire pour le trait MocoLivewireSearchSession
         * afin de sauvegarder les valeurs des propriétés dans la session
         */
        $this->updated();
    }

}
