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
 *  Date : 16/10/22 17:18
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 16-10-22
 */

namespace App\Moco\Datatables\EditFields;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SelectFieldEdit extends EditFieldAbstract
{

    /**
     * @var array
     */
    protected array $options = array();

    /**
     * @param Builder $builder
     * @param string $field
     */
    public function __construct(Builder $builder, string $field)
    {
        $this->getOptions($builder, $field);
    }

    /**
     * @inheritDoc
     */
    public function getViewStringPath(): string
    {
        return 'livewire.data-table.edit-field.select-field-edit';
    }

    /**
     * Les parametres à passer à la vue
     * @return array[]
     */
    public function getViewParameter(): array
    {
        return [
            'options' => $this->options,
            ];
    }

    /**
     * Construit le tableau avec les options au format correct
     *
     * @param Builder $builder
     * @param string $field
     * @return void
     */
    protected function getOptions(Builder $builder, string $field)
    {
        foreach ($builder->select('id', $field)->get() as $item){
            $this->options[$item['id']] = $item[$field];
        }
    }
}
