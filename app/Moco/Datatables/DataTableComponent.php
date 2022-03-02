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
 *  Date : 27/10/21 19:20
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 27-10-21
 */

namespace App\Moco\Datatables;

use App\Moco\Datatables\Traits\Cleanup;
use App\Moco\Datatables\Traits\Export;
use App\Moco\Datatables\Traits\Sorting;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

abstract class DataTableComponent extends Component
{
    use WithPagination,
        Sorting,
        Cleanup,
        Export;

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
     * Charge la variable filter
     */
    public function mount()
    {

        /**
         * Nombre de ligne par page valeur par défaut
         */
        $this->perPage = config('moco.table.perPage');
        /**
         * liste du nombre possible de ligne par page
         */
        $this->perPageOptions = config('moco.table.perPageOptions');
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
        return 'moco-title-table text-left';
    }

    /**
     * Class par colonne pour l'entête
     * peut être surchargé
     *
     * @param Column $column
     * @return null
     */
    public function setTableHeadColumnClass(Column $column): ?string
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
    public function setTableDataClass(): ?string
    {
        return 'text-left';
    }

    /**
     * Class par colonne pour les données
     * peut être surchargé
     *
     * @param Column $column
     * @return string|null
     */
    public function setTableDataColumnClass(Column $column): ?string
    {
        return null;
    }

    /**
     * @return Builder
     */
    public function models(): Builder
    {
        $builder = $this->query();
        if ($this->tableIsFiltered){
            foreach ($this->columns() as $column){
                if ($column->isFiltered()){
                    $filter = $column->getFilter();
                    $builder = $filter->query($builder, $this->filters);
                    $this->filters[$filter->getName()] = $filter->getValue();
                }
            }
        }
        return $builder->orderBy($this->sortField,$this->sortDirection);
    }



}
