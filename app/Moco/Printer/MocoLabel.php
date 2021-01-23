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
 *  Date : 23/01/21 13:57
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 23-01-21
 */

namespace App\Moco\Printer;


trait MocoLabel
{
    /**
     * Format correctement l'étiquette
     *
     * @param string $fr
     * @param string $nl
     * @param string $suffix
     * @param string $separator
     * @return string
     */
    public function formatLabel(string $fr, string $nl, string $suffix = ':', string $separator = ''): string
    {
        $return = '';
        if ($suffix != '')
            $suffix = " $suffix ";
        if ($fr == '' || $nl == ''){
            $return = "$fr$nl$suffix";
        } elseif ($separator == ''){
            $return = "$fr$suffix\n\r$nl   ";
        } else {
            $return = "$fr $separator $nl$suffix";
        }
        return $return;
    }
}
