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
 *  Date : 1/11/21 16:20
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 01-11-21
 */

namespace App\Moco\Datatables\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class NumberFilter extends FilterAbstract
{

    /**
     *
     */
    protected function getNameSelect()
    {
        return $this->getName().'_select';
    }
    /**
     * @inheritDoc
     */
    protected function getViewParameter(): array
    {
        return [
            'name' => [$this->getNameSelect(), $this->getName()],
            'defaultValue' => $this->getDefaultValue(),
        ];

    }

    /**
     * @inheritDoc
     */
    protected function getViewStringPath(): string
    {
        return 'livewire.data-table.filter.number-filter';
    }

    /**
     * @inheritDoc
     */
    public function query(Builder $builder, array $filters): Builder
    {
        /**
         * Récupère les données
         */
        $comparator = $filters[$this->getNameSelect()];
        $value = $this->getNumericValue($filters[$this->getName()]);

        if ($value != '' && !is_null($value)){
            $builder = $builder->where($this->getField(),$comparator,$value);
            $this->value = $this->getFormattedValue($value);
        }
        return $builder;
    }

    /**
     * Retourne un tableau permettant de charge la variable $filters
     * dans le composant Livewire
     * @return array
     */
    public function wireModel(): array
    {
        return [$this->getNameSelect() => '=', $this->getName() => $this->getDefaultValue()];
    }

    /**
     * @param string|null $value
     * @return int
     */
    abstract protected function getNumericValue(?string $value);

    /**
     * @param $value
     * @return mixed
     */
    abstract protected function getFormattedValue($value);
}
