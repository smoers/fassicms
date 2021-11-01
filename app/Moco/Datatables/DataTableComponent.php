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

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

abstract class DataTableComponent extends Component
{
    use WithPagination;

    /**
     * Nombre de page par défault
     * @var int
     */
    protected $pageBy = 10;
    /**
     * Thème du tableau
     * @var string
     */
    protected $paginationTheme = 'bootstrap';
    /**
     * Chemin de la vue à afficher
     * @var null
     */
    protected ?string $renderViewPath = null;
    /**
     * Faut-il checker si des filtres doivent être appliqués
     * @var bool
     */
    public bool $tableIsFiltered = false;
    /**
     * Liste des nom de filtre utiliser pour les actions livewire
     * @var array
     */
    public array $filters = [];

    /**
     * Charge la variable filter
     */
    public function mount()
    {
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
         * une vue est-elle définie
         */
        if (!is_null($this->renderViewPath)) {
            return view($this->renderViewPath, [
                'columns' => $this->columns(),
                'models' => $this->models()->paginate($this->pageBy),
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
     * Défini les actions
     */
    public function FilterActions(): void
    {
        if ($this->tableIsFiltered) {
            foreach ($this->columns() as $column) {
                $filter = $column->getFilter();
                $this->filters[$filter->getName()] = $filter->getDefaultValue();
            }
        }
    }

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
        return $builder;
    }


}
