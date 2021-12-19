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


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

/**
 * Cette classe se charge de l'affichage en mode consultation
 * des modèles
 *
 * Class MocoModelForConsult
 * @package App\Moco\Common
 */
class MocoModelForConsult
{
    protected $model = null;
    protected $extended;
    protected $item_layout = '<tr class="moco-row-table-font-small"><td class="moco-color-info" style="font-style: italic; width: 25%">{{$key}}</td><td>{{$value}}</td></tr>';
    protected $header_layout = '<table class="table table-sm"><thead class="thead-light"><tr><th>Fields</th><th>Values</th></tr></thead><tbody>{{$item}}</tbody></table>';
    protected $collapse_href = '<a class="btn btn-primary" data-toggle="collapse" href="#{{$randomkey}}" role="button" aria-expanded="false" aria-controls="{{$randomkey}}">{{$relation}} <i class="fas fa-caret-right"></i></a>';
    protected $collapse_content = '<div class="collapse" id="{{$randomkey}}">{{$table}}</div>';
    protected $follow = [];

    /**
     * Constructeur
     *
     * @param MocoModelForConsultInterface $model
     * @param bool $extended
     */
    public function __construct(MocoModelForConsultInterface $model, bool $extended = true)
    {
        $this->model = $model;
        $this->extended = $extended;
        $this->follow = config('moco.consult.follow');
    }

    /**
     * Retourne le contenu HTML à passer à la vue
     * qui se charge de l'affichage
     *
     * @return string|null
     */
    public function getBladeLayout(): ? string
    {
        return $this->getBladeLayoutModel();
    }

    /**
     * Retourne le contenu HTML en chassé dans une balise <TABLE>
     *
     * @return string|null
     */
    protected function getBladeLayoutModel(): ?string
    {
        return $this->insertTable($this->getBladeLayoutModelExtended());
    }

    /**
     * Construit le HTML
     *
     * @return String|null
     */
    protected function getBladeLayoutModelExtended(): ?String
    {
        $layout = $this->getAttributesLayoutRow($this->model);
        if ($this->extended)
            $layout .= $this->getBladeLayoutRelations();
        return $layout;
    }

    /**
     * Retourne le HTML des relations du modele principal
     *
     * @return string|null
     */
    protected function getBladeLayoutRelations(): ?string
    {
        $layout = '';
        /**
         * pour chaque relation fournie par la méthode WithForConsult
         * on recherche les données du ou des modèles liés
         */
        foreach ($this->model->WithForConsult() as $relation){
            if ($this->model->$relation instanceof Collection){
                /**
                 * le layout temporaire avant de l'insérer dans
                 * le layout définitif
                 */
                $layoutTemp = '';
                /**
                 * si la relation retourne une collection, il faut la parcourir
                 */
                foreach ($this->model->$relation->all() as $model){
                    /**
                     * on défini la clé pour le collapse
                     */
                    $randomKey = 'k'.Moco::randomKey();
                    if (!is_null($model->id))
                        $idKey = $model->id;
                    else
                        $idKey = '?';
                    $layoutTemp .= $this->insertRow(
                        $this->insertCollapseHref($randomKey,$idKey),
                        $this->insertCollapseContent($randomKey,$this->getAttributesLayoutTable($model))
                    );
                }
                /**
                 * on défini la clé pour le collapse
                 */
                $randomKey = 'k'.Moco::randomKey();
                $layout .= $this->insertRow(
                    $this->insertCollapseHref($randomKey,$relation),
                    $this->insertCollapseContent($randomKey,$this->insertTable($layoutTemp))
                );
            } else {
                /**
                 * on défini la clé pour le collapse
                 */
                $randomKey = 'k'.Moco::randomKey();
                $model = $this->model->$relation;
                if (!is_null($model)) {
                    $layout .= $this->insertRow(
                        $this->insertCollapseHref($randomKey, $relation),
                        $this->insertCollapseContent($randomKey, $this->getAttributesLayoutTable($model))
                    );
                }
            }
        }
        return $layout;
    }

    /**
     * Construit une ligne du tableau par attributs du modèle
     *
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

    /**
     * En chasse les lignes avec les attributs dans une balise <TABLE>
     *
     * @param Model $model
     * @return string|null
     */
    protected function getAttributesLayoutTable(Model $model): ?string
    {
        return $this->insertTable($this->getAttributesLayoutRow($model));
    }

    /**
     * Insère les valeurs dans les balises HTML de basses
     *
     * @param string|null $key
     * @param string|null $value
     * @return string|null
     */
    protected function insertRow(?string $key, ?string $value): ?string
    {
        return str_replace(['{{$key}}','{{$value}}'],[$key,$value],$this->item_layout);
    }

    /**
     * Insère les balises HTML de basses dans les balises du tableau de basses
     *
     * @param string|null $item
     * @return string|null
     */
    protected function insertTable(?string $item): ?string
    {
        return str_replace('{{$item}}',$item,$this->header_layout);
    }

    protected function insertCollapseHref(string $randomKey, string $relation)
    {
        return str_replace(['{{$randomkey}}','{{$relation}}'],[$randomKey,trans(ucfirst($relation))],$this->collapse_href);
    }

    protected function insertCollapseContent(string $randomKey, string $table)
    {
        return str_replace(['{{$randomkey}}','{{$table}}'],[$randomKey,$table],$this->collapse_content);
    }

    /**
     * Obtenir les infos depuis le fichier de configuration
     *
     * @param string $key
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function getField(string $key, $default = null)
    {
        return config('moco.consult.fields.'.$key,$default);
    }

    /**
     * Converti une valeur
     *
     * @param string $table_name
     * @param string $field
     * @param $value
     * @return mixed|string
     */
    protected function valueConverter(string $table_name, string $field, $value)
    {
        switch (Schema::getColumnType($table_name, $field)){
            case 'boolean':
                $value = $value == 1 ? trans('Yes') : trans('No');
                break;
            case 'decimal':
                $value = number_format(intval($value),2,',','');
                break;
            case 'datetime':
                $value = Carbon::parse($value)->format('d/m/Y H:i');
                break;
        }
        return $value;
    }

    /**
     * Cette méthode permet de récupérer des informations spécifiées dans le fichier de configuration
     * depuis les relations du modèle principal
     *
     *     'consult' => [
     *          'follow' => [
     *              'location_id' => 'location:location|description',
     *              'provider_id' => 'provider:name',
     *              'user_id' => 'user:firstname|lastname',
     *              'customer_id' => 'customer:name|address|zipcode|city|country',
     *              'crane_id' => 'crane:serial|model|plate',
     *          ],
     *
     * @param Model $model
     * @param string $follow
     * @return string|null
     */
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
