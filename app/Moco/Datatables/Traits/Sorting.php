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
 *  Date : 4/11/21 19:25
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 04-11-21
 */

namespace App\Moco\Datatables\Traits;

trait Sorting
{
    /**
     * The initial field to be sorting by.
     *
     * @var string
     */
    public string $sortField = 'id';

    /**
     * The initial direction to sort.
     *
     * @var string
     */
    public string $sortDirection = 'asc';
    /**
     * @var string
     */
    public string $sortDefaultIcon = '<i class="fas fa-sort-alpha-down"></i>';
    /**
     * @var string
     */
    public string $ascSortIcon = '<i class="fas fa-sort-alpha-up"></i>';
    /**
     * @var string
     */
    public string $descSortIcon = '<i class="fas fa-sort-alpha-down"></i>';

    /**
     * @param $attribute
     */
    public function sort($attribute): void
    {
        if ($this->sortField !== $attribute) {
            $this->sortDirection = 'asc';
        } else {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }

        $this->sortField = $attribute;
    }
}
