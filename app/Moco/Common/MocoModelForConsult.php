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
 *  Date : 24/05/21 12:53
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 24-05-21
 */

namespace App\Moco\Common;


use Illuminate\Database\Eloquent\Model;

class MocoModelForConsult
{
    protected $model = null;
    protected $consult_array = null;
    protected $default_config = null;
    protected $item_layout = '<tr class="moco-row-table-font-small"><td class="moco-color-info" style="font-style: italic">{{$key}}</td><td>{{$value}}</td></tr>';
    protected $header_layout = '<table class="table table-sm"><thead class="thead-light"><tr><th>Fields</th><th>Values</th></tr></thead><tbody>{{$item}}</tbody></table>';

    /**
     * MocoModelForConsult constructor.
     * @param null $consult_array
     */
    public function __construct(Model $model)
    {
        $this->default_config = $this->getConfig($model->getTable());
        $this->consult_array = $model->toArray();
    }

    public function getBladeLayout()
    {
        return $this->browse($this->consult_array);
    }

    protected function browse(array $node)
    {
        $layout = '';
        foreach ($node as $key => $value){
            if (is_array($value)){
                $layout .= $this->insertRow($key,$this->browse($value));
            } else {
                $layout .= $this->insertRow($key, $value);
            }
        }
        return $this->insertTable($layout);
    }

    protected function insertRow(?string $key, ?string $value)
    {
        return str_replace(['{{$key}}','{{$value}}'],[$key,$value],$this->item_layout);
    }

    protected function insertTable(?string $item)
    {
        return str_replace('{{$item}}',$item,$this->header_layout);
    }

    protected function getConfig(string $key)
    {

    }



}
