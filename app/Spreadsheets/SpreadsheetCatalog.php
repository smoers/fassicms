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
 *  Date : 2/10/22 13:34
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 02-10-22
 */

namespace App\Spreadsheets;

use App\Moco\Datatables\ColumnEdit;
use App\Moco\Datatables\EditFields\SelectBooleanFieldEdit;
use App\Moco\Datatables\EditFields\TextFieldEdit;
use App\Moco\Datatables\Filters\SelectBooleanFilter;
use App\Moco\Datatables\Filters\TextFilter;
use App\Moco\Datatables\SpreadsheetDataTableComponent;
use App\Models\Partmetadata;
use Illuminate\Database\Eloquent\Builder;

class SpreadsheetCatalog extends SpreadsheetDataTableComponent
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

    /**
     * @inheritDoc
     */
    public function query(): Builder
    {
        return Partmetadata::query()->select()->addSelect('partmetadatas.enabled AS meta_enabled')
            ->leftJoin('catalogs','partmetadatas.id','=','catalogs.partmetadata_id')
            ->leftJoin('providers','providers.id','=','catalogs.provider_id');
    }

    /**
     * @inheritDoc
     */
    public function columns(): array
    {
        return [
            ColumnEdit::make(trans('Part Number'),'part_number')
                ->setSortable()
                ->setFilter(new TextFilter('part_number'))
                ->setEditField(new TextFieldEdit()),
            /** description **/
            ColumnEdit::make(trans('Description'),'description')
                ->setSortable()
                ->setFilter(new TextFilter('description'))
                ->setEditField(new TextFieldEdit()),
            /** partmetadatas.enabled **/
            ColumnEdit::make(trans('Enabled'),'meta_enabled')
                ->setFilter(new SelectBooleanFilter('meta_enabled', 2))
                ->setEditField(new SelectBooleanFieldEdit()),
        ];
    }

}
