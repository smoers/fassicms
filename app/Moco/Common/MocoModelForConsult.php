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


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Scalar\String_;

class MocoModelForConsult
{
    protected $model = null;
    protected $extended;
    protected $item_layout = '<tr class="moco-row-table-font-small"><td class="moco-color-info" style="font-style: italic">{{$key}}</td><td>{{$value}}</td></tr>';
    protected $header_layout = '<table class="table table-sm"><thead class="thead-light"><tr><th>Fields</th><th>Values</th></tr></thead><tbody>{{$item}}</tbody></table>';
    protected $follow = [];

    /**
     * MocoModelForConsult constructor.
     * @param null $consult_array
     */
    public function __construct(MocoModelForConsultInterface $model, bool $extended = true)
    {
        $this->model = $model;
        $this->extended = $extended;
        $this->follow = config('moco.consult.follow');
    }

    /**
     * @return string|null
     */
    public function getBladeLayout(): ? string
    {
        return $this->getBladeLayoutModel();
    }

    /**
     * @return string|null
     */
    protected function getBladeLayoutModel(): ?string
    {
        return $this->insertTable($this->getBladeLayoutModelExtended());
    }

    protected function getBladeLayoutModelExtended(): ?String
    {
        $layout = $this->getAttributesLayoutRow($this->model);
        if ($this->extended)
            $layout .= $this->getBladeLayoutRelations();
        return $layout;
    }

    /**
     * @return string|null
     */
    protected function getBladeLayoutRelations(): ?string
    {
        $layout = '';
        foreach ($this->model->WithForConsult() as $relation){
            if ($this->model->$relation instanceof Collection){
                foreach ($this->model->$relation->all() as $model){
                    $layout .= $this->insertRow($relation,$this->getAttributesLayoutTable($model));
                }
            } else {
                $model = $this->model->$relation;
                $layout .= $this->insertRow($relation,$this->getAttributesLayoutTable($model));
            }
        }
        return $layout;
    }

    /**
     * @param Model $model
     * @return string|null
     */
    protected function getAttributesLayoutRow(Model $model): ?string
    {
        $layout = '';
        $table_name = $model->getTable();
        foreach ($model->getAttributes() as $key => $value){
            if ($this->getField($table_name.'.show.'.$key,true)) {
                $_name = $this->getField($table_name . '.name.' . $key, $key);
                if (array_key_exists($key,$this->follow)){
                    $_value = $this->getFollowLink($model,$this->follow[$key]);
                } else {
                    $_value = $this->valueConverter($table_name, $key, $value);
                }
                $layout .= $this->insertRow(trans($_name), $_value);
            }
        }
        return $layout;
    }

    protected function getAttributesLayoutTable(Model $model): ?string
    {
        return $this->insertTable($this->getAttributesLayoutRow($model));
    }

    protected function insertRow(?string $key, ?string $value): ?string
    {
        return str_replace(['{{$key}}','{{$value}}'],[$key,$value],$this->item_layout);
    }

    protected function insertTable(?string $item): ?string
    {
        return str_replace('{{$item}}',$item,$this->header_layout);
    }

    /**
     * @param string $key
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function getField(string $key, $default = null)
    {
        return config('moco.consult.fields.'.$key,$default);
    }

    protected function valueConverter(string $table_name, string $field, $value)
    {
        switch (Schema::getColumnType($table_name, $field)){
            case 'boolean':
                $value = $value == 1 ? 'yes' : 'no';
        }
        return $value;
    }

    protected function getFollowLink(Model $model, string $follow)
    {
        $content = null;
        $follows = explode(':',$follow);
        $relation = $follows[0];
        $list_fields = explode('|',$follows[1]);
        $relation_model = $model->{$relation}()->first();
        foreach ($list_fields as $field){
            $content .= (!is_null($content)? '</br>' : '').$relation_model->getAttribute($field);
        }
        return $content;
    }



}
