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
 *  Date : 27/10/21 19:26
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 27-10-21
 */

namespace App\Moco\Datatables;

abstract class DataTableExportComponent extends DataTableComponent
{
    protected string $fieldsExcludePath = 'moco.datatable.fields.excluded';

    /**
     * @param array $tables
     * @return array
     */
    protected function makeColumns(array $tables = []): array
    {
        /**
         * Liste des objets colonne
         */
        $columns = [];
        /**
         * Champs à exclures
         */
        $excluded = $this->getFieldsExcluded();
        /**
         * Parcours chaque table
         */
        foreach ($tables as $table){
            /**
             * liste des champs pour cette table
             */
            $fields = $this->getFieldsName($table);
            foreach ($fields as $field => $name){
                if(!in_array($field,$excluded)){
                    array_push(
                        $columns,
                        Column::make(trans($name),$field)
                    );
                }
            }
        }
        return $columns;

    }

    /**
     * @return array
     */
    protected function getFieldsExcluded(): array
    {
        return config($this->fieldsExcludePath);
    }

    /**
     * @param string $table
     * @return array
     *
     */
    protected function getFieldsName(string $table): array
    {
        return config('moco.consult.fields.'.$table.'.name');
    }




}
