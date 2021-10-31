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
 *  Date : 31/10/21 15:25
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 31-10-21
 */

namespace App\Moco\Datatables\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class FilterAbstract implements FilterInterface
{
    /**
     * Nom du filtre
     * @var string
     */
    protected string $name;
    /**
     * Valeur par default
     * @var
     */
    protected $defaultValue;

    /**
     * @param string $name
     * @param null $defaultValue
     */
    public function __construct(string $name, $defaultValue = null)
    {
        $this->name = $name;
        $this->defaultValue = $defaultValue;
    }

    /**
     * Retourne le nom du filtre
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Retourne la vue
     * @return mixed
     */
    public function show()
    {
        return view($this->getViewStringPath(),$this->getViewParameters());
    }

    /**
     * Liste des paramétres à passer à la vue
     *
     * @return array
     */
    private function getViewParameters(): array
    {
        return array_merge(['name' => $this->getName()], $this->getViewParameter());
    }

    /**
     * Liste des paramètres optionels à passer à la vue
     *
     * @return array
     */
    abstract protected function getViewParameter(): array;

    /**
     * Nom et chemin de la vue
     *
     * @return string
     */
    abstract protected function getViewStringPath(): string;

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * Applique les conditions sur le Builder
     * @param Builder $builder
     * @param array $filters
     * @return Builder
     */
    abstract public function query(Builder $builder,array $filters): Builder;

}
