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
 *  Date : 22/10/21 13:44
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 22-10-21
 */

namespace App\Moco\Reporting;

use Illuminate\Support\HtmlString;

class MocoReportingTools
{
    /**
     * @throws \Throwable
     */
    public function run()
    {
        $args = func_get_arg(0);
        $parameters = explode(',',str_replace(' ','',str_replace("'",'',$args)));
        if (count($parameters) < 2){
            return new HtmlString('<h5>Error</h5>');
        }
        $name = $parameters[1];
        $fields = config('moco.consult.fields.'.$parameters[0].'.name');
        return new HtmlString($this->makeFormGroupSelect($fields,'select_'.$name, trans($name)));
    }

    /**
     *
     * @param array $fields
     * @return string[]|null
     */
    public function makeSelectFieldList(array $fields, string $id): ?array
    {
        $string = ['<select class="form-control form-control-sm" id="'.$id.'">'];
        foreach ($fields as $field => $name){
            array_push($string,'<option value="'.$field.'">'.trans($name).'</option>');
        }
        array_push($string,'</select>');
        return $string;
    }

    public function makeLabel(string $label, $id): array
    {
        return [0 => '<label for="'.$id.'">'.$label.'</label>'];
    }

    /**
     * @return string[]
     */
    public function makeFormGroup(int $emptyKeys = 2): array
    {
        return [0 => '<div class="form-group">', ($emptyKeys + 1) => '</div>'];
    }

    public function makeFormGroupSelect(array $fields, string $id, string $label): string
    {
        $group = $this->makeFormGroup();
        $group[1] = $this->makeLabel($label, $id);
        $group[2] = $this->makeSelectFieldList($fields, $id);
        return $this->implode_r('', $group);
    }

    private function implode_r($glue, array $arr)
    {
        $ret = '';

        foreach($arr as $piece)
        {
            if(is_array($piece))
                $ret .= $glue . $this->implode_r($glue, $piece);
            else
                $ret .= $glue . $piece;
        }

        return $ret;
    }
}
