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
 *  Date : 13/02/22 16:05
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 09-02-22
 */

namespace App\Moco\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DataTableQueryBuilder
{

    protected array $tables = [];
    protected array $select = [];
    protected string $model_prefix = 'App\\Models\\';

    /**
     * @param array $select
     */
    public function __construct(... $tables)
    {
        $this->tables = $tables[0];
        foreach ($this->tables as $table){
            foreach (Schema::getColumnListing($table) as $column){
                $field = $table.'.'.$column;
                $alias = $this::alias($field);
                array_push($this->select, $field.' as '.$alias);
            }
        }
    }

    /**
     * @param ...$tables
     * @return static
     */
    public static function make(... $tables)
    {
        return new static($tables);
    }

    /**
     * Contruit le select du query avec des alias
     *
     * @param array $tables
     * @return array
     */
    public function getSelect(): array
    {
        return $this->select;
    }

    public function builder(): Builder
    {
        $model = $this->model_prefix . Str::studly(str::singular($this->tables[0]));
        return $model::query()->select($this->getSelect());
    }

    /**
     * Construit l'alias
     *
     * @param string $attribute
     * @return string
     */
    public static function alias(string $attribute)
    {
        return Str::replaceFirst('.','-',$attribute);
    }

}
