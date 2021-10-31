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
 *  Date : 31/10/21 15:18
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 31-10-21
 */

namespace App\Moco\Datatables\Filters;

use Illuminate\Database\Eloquent\Builder;

class TextFilter extends FilterAbstract
{
    /**
     * Applique les conditions sur le Query
     * @param Builder $builder
     * @param array $filters
     * @return Builder
     */
    public function query(Builder $builder, array $filters): Builder
    {
        $return = $builder;
        if ($filters[$this->getName()] != '' && !is_null($filters[$this->getName()])){
            //dd($filters[$this->getName()]);
            $return->where($this->getName(),'like','%'.$filters[$this->getName()].'%');
        }
        return $return;
    }

    /**
     * Paramètre a passer vers la vue
     * @return array
     */
    protected function getViewParameter(): array
    {
        return [];
    }

    /**
     * Chemin vers la vue
     * @return string
     */
    protected function getViewStringPath(): string
    {
        return 'livewire.data-table.filter.text-filter';
    }


}
