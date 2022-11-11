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
 *  Date : 2/10/22 13:34
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 02-10-22
 */

namespace App\Spreadsheets;

use App\Moco\Datatables\Column;
use App\Moco\Datatables\EditFields\FloatNumberFieldEdit;
use App\Moco\Datatables\SpreadsheetCatalogRequest;
use App\Moco\Datatables\StorePartRequest;
use App\Moco\Datatables\ColumnEdit;
use App\Moco\Datatables\EditFields\NumberFieldEdit;
use App\Moco\Datatables\EditFields\SelectBooleanFieldEdit;
use App\Moco\Datatables\EditFields\SelectFieldEdit;
use App\Moco\Datatables\EditFields\TextFieldEdit;
use App\Moco\Datatables\Filters\FloatNumberFilter;
use App\Moco\Datatables\Filters\IntNumberFilter;
use App\Moco\Datatables\Filters\SelectBooleanFilter;
use App\Moco\Datatables\Filters\TextFilter;
use App\Moco\Datatables\SpreadsheetDataTableComponent;
use App\Models\Partmetadata;
use App\Models\Provider;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpreadsheetCatalog extends SpreadsheetDataTableComponent
{
    /**
     * Tableau avec un filtre
     * @var bool
     */
    public bool $tableIsFiltered = true;
    /**
     * sort field part défaut
     * @var string
     */
    public string $sortField = 'part_number';
    /**
     * @var FormRequest|null
     */
    protected ?FormRequest $formRequest = null;

    public function __construct()
    {
        $this->formRequest = new SpreadsheetCatalogRequest();
        parent::__construct();
    }


    /**
     * @inheritDoc
     */
    public function query(): Builder
    {
        return Partmetadata::query()->select()->addSelect('partmetadatas.id AS id','catalogs.id AS cat_id','partmetadatas.enabled AS meta_enabled','providers.id AS pro_id')
            ->selectRaw('FORMAT(catalogs.price,3,"fr_BE") AS "price"')
            ->leftJoin('catalogs','partmetadatas.id','=','catalogs.partmetadata_id')
            ->leftJoin('providers','providers.id','=','catalogs.provider_id')
            ->where('year','=',Carbon::now()->year);
    }

    /**
     * @inheritDoc
     */
    public function columns(): array
    {
        return [
            /** part_number **/
            ColumnEdit::make(trans('Part Number'),'part_number')
                ->setSortable()
                ->setFilter(new TextFilter('part_number'))
                ->setEditField(new TextFieldEdit()),
            /** bar_code **/
            ColumnEdit::make(trans('BarCode'),'bar_code')
                ->setSortable()
                ->setFilter(new TextFilter('bar_code'))
                ->setEditField(new TextFieldEdit()),
            /** description **/
            ColumnEdit::make(trans('Description'),'description')
                ->setSortable()
                ->setFilter(new TextFilter('description'))
                ->setEditField(new TextFieldEdit()),
            /** electrical_part **/
            ColumnEdit::make(trans('Electrical Part'),'electrical_part')
                ->setFilter(new selectBooleanFilter('electrical_part'))
                ->setEditField(new SelectBooleanFieldEdit()),
            /** reassort_level **/
            ColumnEdit::make(trans('Reassort Level'), 'reassort_level')
                ->setSortable()
                ->setFilter(new IntNumberFilter('reassort_level'))
                ->setEditField(new NumberFieldEdit()),
            /** price **/
            ColumnEdit::make(trans('Price'),'price')
                ->setSortable()
                ->setFilter(new FloatNumberFilter('price'))
                ->setEditField(new FloatNumberFieldEdit()),
            /** provider **/
            ColumnEdit::make(trans('Provider'), 'pro_id')
                ->setSortable()
                ->setFilter(new TextFilter('name'))
                ->setEditField(new SelectFieldEdit(Provider::query() ,'name')),
            /** partmetadatas.enabled **/
            ColumnEdit::make(trans('Enabled'),'meta_enabled')
                ->setFilter(new SelectBooleanFilter('partmetadatas.enabled', 2))
                ->setEditField(new SelectBooleanFieldEdit()),
        ];
    }

    /**
     * Sauvegarde les données
     * @return mixed|void
     */
    public function save()
    {
        /**
         * On valide les valeurs du tableau
         */
        $this->validate($this->getRules(),$this->getMessages(),$this->getAttributes());
        /**
         * Charge les modèles
         */
        //dd($this->wireData);
    }

    /**
     * Cette méthode retourne un tableau avec les régles pour assurer l'unicité du part_number et du code barre
     *
     * @return array
     */
    protected function getRules(): array
    {
        $uniqueRules = $this->formRequest->rules();
        foreach ($this->wireData as $key => $model){
            $uniqueRules['wireData.'.$key.'.part_number'] = Rule::unique('partmetadatas','part_number')->ignore($model['id']);
            $uniqueRules['wireData.'.$key.'.bar_code'] = Rule::unique('partmetadatas','bar_code')->ignore($model['id']);
        }
        return $uniqueRules;
    }

    /**
     * Les messages dans le cas d'une erreur
     * @return array
     */
    protected function getMessages(): array
    {
        return $this->formRequest->messages();
    }

    /**
     * Le non des attributs
     *
     * @return array
     */
    protected function getAttributes(): array
    {
        return $this->formRequest->attributes();
    }
}
