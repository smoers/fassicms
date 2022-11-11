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
 *  Date : 16/10/22 15:37
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 16-10-22
 */

namespace App\Moco\Datatables\EditFields;

use App\Moco\Datatables\ColumnEdit;
use App\Moco\Datatables\ColumnInterface;

abstract class EditFieldAbstract implements EditFieldInterface
{

    /**
     * Retourne la vue
     * @return mixed
     */
    public function show(int $index, ColumnInterface $column)
    {
        return view($this->getViewStringPath(),$this->getViewParameters([
            'index' => $index,
            'alias' => $column->getAlias(),
            'class' => $this->setFormClass($column),
        ]));
    }

    /**
     * Nom et chemin de la vue
     *
     * @return string
     */
    abstract public function getViewStringPath(): string;

    abstract public function getViewParameter(): array;

    protected function getViewParameters(array $common): array
    {
        return array_merge($common,$this->getViewParameter());
    }
    protected function setFormClass(ColumnEdit $columnEdit): string
    {
        if ($columnEdit->isEditMode())
            return 'form-control moco-form-control-vsm moco-edit-mode';
        else
            return 'form-control moco-form-control-vsm';
    }
}
