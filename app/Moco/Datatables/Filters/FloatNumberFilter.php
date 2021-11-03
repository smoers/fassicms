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
 *  Date : 3/11/21 17:52
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 03-11-21
 */

namespace App\Moco\Datatables\Filters;

use Illuminate\Support\Str;

class FloatNumberFilter extends NumberFilter
{
    /**
     * @param string|null $value
     * @return float|int|void
     */
    protected function getNumericValue(?string $value)
    {
        if (Str::contains($value, [','])) {
            return floatval(Str::replaceFirst(',','.',$value));
        } elseif (!is_null($value)) {
            return floatval($value);
        }
    }

    /**
     * @param $value
     * @return mixed|string
     */
    protected function getFormattedValue($value)
    {
        return $value;
    }
}
