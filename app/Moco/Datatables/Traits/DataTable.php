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
 *  Date : 8/12/22 18:02
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 08-12-22
 */

namespace App\Moco\Datatables\Traits;

use App\Moco\Datatables\Column;
use App\Moco\Datatables\ColumnInterface;
use Illuminate\Database\Eloquent\Builder;

trait DataTable
{
    /**
     * Titre du rapport
     *
     * @var string
     */
    public string $title = '';
    /**
     * Nombre de page par défault
     * @var int
     */
    public $perPage = 10;
    /**
     * line par page
     * @var int[]
     */
    public $perPageOptions;
    /**
     * Thème du tableau
     * @var string
     */
    protected $paginationTheme = 'bootstrap';
    /**
     * Chemin de la vue à afficher
     * @var null
     */
    public ?string $renderViewPath = null;
    /**
     * Faut-il checker si des filtres doivent être appliqués
     * @var bool
     */
    public bool $tableIsFiltered = false;
    /**
     * Liste des nom de filtre utiliser pour les actions livewire
     * @var array
     */
    public $filters = [];
    /**
     * Détermine si nous sommes en mode edit
     * @var bool
     */
    public bool $editMode = false;
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
    public string $perPageConfig = 'moco.table.perPage';
    /**
     * Le chemin dans le fichier de config avec la valeur des par page options
     * @var string
     */
    public string $perPageOptionsConfig = 'moco.table.perPageOptions';

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        /**
         * déclenche l'event javascript pour le resizing des colonnes
         */
        $this->dispatchBrowserEvent('resizable');
        /**
         * une vue est-elle définie
         */
        if (!is_null($this->renderViewPath)) {
            return view($this->renderViewPath, [
                'columns' => $this->columns(),
                'models' => $this->models()->paginate($this->perPage),
            ]);
        }
        /**
         * retourne une vue vide car pas de vue définie par la variable $renderViewPath
         */
        return view('livewire.data-table.view');
    }

    /**
     * Initialise le composant de base
     */
    public function init()
    {
        /**
         * Nombre de ligne par page valeur par défaut
         */
        $this->perPage = config($this->perPageConfig);
        /**
         * liste du nombre possible de ligne par page
         */
        $this->perPageOptions = config($this->perPageOptionsConfig);
        /**
         * Initialise le tableau avec le nom des champs disposants d'un filtre
         */
        foreach ($this->columns() as $column){
            if ($column->isFiltered()){
                $this->filters = array_merge($this->filters,$column->getFilter()->wireModel());
            }
        }
    }
    /**
     * @return Builder
     */
    public abstract function query(): Builder;

    /**
     * @return array
     */
    public abstract function columns(): array;

    /**
     * Class global pour l'entête du tableau
     * peut être surchargé
     *
     * @return null
     */
    public function setTableHeadClass(): ?string
    {
        return null;
    }

    /**
     * Class par colonne pour l'entête
     * peut être surchargé
     *
     * @param Column $column
     * @return null
     */
    public function setTableHeadColumnClass(ColumnInterface $column): ?string
    {
        return null;
    }

    /**
     * Class pour les données
     * peut être surchargé
     *
     * @param Column $column
     * @return string|null
     */
    public function setTableDataRowClass(): ?string
    {
        return null;
    }

    /**
     * Class par colonne pour les données
     * peut être surchargé
     *
     * @param Column $column
     * @return string|null
     */
    public function setTableDataColumnClass(ColumnInterface $column): ?string
    {
        return null;
    }

    /**
     * Class pour le tableau complet
     * peut être surchargé
     *
     * @return string|null
     */
    public function setTableDataClass(): ?string
    {
        return null;
    }

}
