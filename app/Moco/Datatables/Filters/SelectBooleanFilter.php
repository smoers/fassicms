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
 *  Date : 1/11/21 14:24
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 01-11-21
 */

namespace App\Moco\Datatables\Filters;

use Illuminate\Database\Eloquent\Builder;

class SelectBooleanFilter extends FilterAbstract
{

    /**
     * @inheritDoc
     */
    protected function getViewParameter(): array
    {
        return [
            'options' => [
                2 => '',
                1 => trans('Yes'),
                0 => trans('No'),
            ],
            'selected' => $this->getDefaultValue(),
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getViewStringPath(): string
    {
        return 'livewire.data-table.filter.select-filter';
    }

    /**
     * @inheritDoc
     */
    public function query(Builder $builder, array $filters): Builder
    {

        if ($filters[$this->getName()] != 2 && !is_null($filters[$this->getName()])){
            $builder = $builder->where($this->getField(),'=',$filters[$this->getName()]);
            $this->value = $filters[$this->getName()];
        }
        return $builder;
    }
}
