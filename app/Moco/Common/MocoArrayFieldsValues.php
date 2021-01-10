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
 *  Date : 10/01/21 12:42
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 10-01-21
 */

namespace App\Moco\Common;


use Illuminate\Database\Eloquent\Model;

trait MocoArrayFieldsValues
{
    /**
     * Cette méthode permet de convertir un objet de type Model vers une Array
     * mais avec une Key personnaliése
     *
     * @param array $array
     * @param Model $model
     * @param array|null $translate
     */
    protected function arrayFieldsValues(array $array, Model $model, array $translate = null)
    {
        foreach ($model->getAttributes() as $key => $value){
            if (!is_null($translate) && array_key_exists($key,$translate))
                $key = $translate[$key];
            $array[$key] = $value;
        }

        return $array;
    }
}
