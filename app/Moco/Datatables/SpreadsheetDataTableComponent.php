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
 *  Date : 2/10/22 17:40
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 02-10-22
 */

namespace App\Moco\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;

abstract class SpreadsheetDataTableComponent extends DataTableComponent
{
    /**
     * Tableau contenant les données utilisées par le tableau en mode édition seulement
     * @var array
     */
    public array $wireData;
    /**
     * Tabelau contenant les index des données modifiées
     * @var array
     */
    protected array $wireDataKeyModified = [];
    /**
     * Place le tableau en mode édition
     * @var bool
     */
    public bool $editMode = true;
    /**
     * des données ont-elle été modifiées dans le tableau
     * Détermine si un filtre ou un changement de page peut-être possible ou pas
     * @var bool
     */
    public bool $edit = false;
    /**
     * Le chemin dans le fichier de config avec la valeur par défaut par page
     * @var string
     */
    public string $perPageConfig = 'moco.table.edit.perPage';
    /**
     * Le chemin dans le fichier de config avec la valeur des par page options
     * @var string
     */
    public string $perPageOptionsConfig = 'moco.table.edit.perPageOptions';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public abstract function query(): Builder;

    /**
     * @inheritDoc
     */
    public abstract function columns(): array;

    /**
     * Permet de sauvegarder les modifications
     * @return mixed
     */
    public abstract function save();

    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function getMessages(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function getAttributes(): array
    {
        return [];
    }

    /**
     * Modifie l'affichage du tableau complet
     *
     * @return string|null
     */
    public function setTableDataClass(): ?string
    {
        return 'data table table-striped table-bordered moco-table-vsm';
    }

    /**
     * On surcharge la méthode afin de pouvoir charger le tableau de données
     * qui doit être utilisé pour l'édition des données.
     *
     * @return Builder
     */
    public function models(): Builder
    {
        $models = parent::models();
        /**
         * On charge le tableau avec les données provenant du query
         * mais uniquement si l'on n'est pas en mode edit
         */
        if (!$this->edit)
            $this->wireData = $models->paginate($this->perPage)->items();
        return $models;
    }

    /**
     * Action sur le changement d'une valeur
     *
     * @param $propertyName
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($propertyName)
    {
        /**
         * on ne passe en mode edit que si les critères suivants ne sont pas rencontrés
         */
        if(!str_starts_with($propertyName,'filters.') && $propertyName != 'perPage' ) {
            $this->edit = true;
            $this->addModified($propertyName);
            $this->validate($this->getRules(),$this->getMessages(),$this->getAttributes());
        }

    }

    /**
     * Cette méthode est appelée par le bouton Edit Mode pour sortir du mode édition
     *
     * @param bool $value
     * @return void
     */
    public function editMode(bool $value)
    {
        $this->edit = $value;
        //On vide le error bag
        $this->resetValidation();
    }

    public static function getErrorMessageHTML(int $index, string $alias, ViewErrorBag $errorBag)
    {
        $return = '';
        if ($errorBag->isNotEmpty()){
            $return = implode(', ', $errorBag->get('wireData.' . $index . '.' . $alias));
        }
        return $return;
    }

    /**
     * @param $propertyName
     * @return void
     */
    protected function addModified($propertyName)
    {
        /**
         * on divise le chemin
         */
        $index = Str::between($propertyName,'.','.');
        /**
         * on marque le record comme ayant été modifier
         */
        array_push($this->wireDataKeyModified,$index);
        dd($this->wireDataKeyModified);

    }

}
