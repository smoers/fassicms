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
 *  Date : 2/10/22 14:20
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 02-10-22
 */

namespace App\Moco\Datatables;

use App\Moco\Datatables\EditFields\EditFieldInterface;
use App\Moco\Datatables\Filters\FilterInterface;
use App\Moco\Datatables\Traits\RandomKey;
use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;

class ColumnEdit implements ColumnInterface
{
    use RandomKey;

    /**
     * @var string
     */
    protected string $name;
    /**
     * @var string|null
     */
    protected ?string $attribute;
    /**
     * @var string|null
     */
    protected ?string $alias;
    /**
     * @var FilterInterface|null
     */
    protected ?FilterInterface $filterObject = null;
    /**
     * @var bool
     */
    protected bool $isSortable = false;
    /**
     * @var EditFieldInterface
     */
    protected EditFieldInterface $editField;
    /**
     * @var bool
     */
    protected bool $isEditMode = false;

    /**
     * @param string $name
     * @param string $attribute
     */
    public function __construct(string $name, ?string $attribute)
    {
        $this->name = $name;
        $this->attribute = $attribute ?? Str::snake(Str::lower($name));;
        $this->alias = DataTableQueryBuilder::alias($this->attribute);
    }

    /**
     * @param string $name
     * @param string $attribute
     * @return Column
     */
    public static function make(string $name, ?string $attribute = null): ColumnEdit
    {
        return new static($name, $attribute);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAttribute(): ?string
    {
        return $this->attribute;
    }

    /**
     * @return string|null
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function getEditField(int $index,ColumnInterface $column)
    {
        return $this->editField->show($index, $column);
    }

    public function setEditField(EditFieldInterface $editField): ColumnEdit
    {
        $this->editField = $editField;

        return $this;
    }

    /**
     * @return FilterInterface
     */
    public function getFilter(): FilterInterface
    {
        return $this->filterObject;
    }

    /**
     * @param FilterInterface $filterObject
     */
    public function setFilter(FilterInterface $filter): ColumnEdit
    {
        $this->filterObject = $filter;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFiltered(): bool
    {
        return !is_null($this->filterObject);
    }

    /**
     * @return bool
     */
    public function isSortable(): bool
    {
        return $this->isSortable;
    }

    /**
     * @return $this
     */
    public function setSortable(): ColumnEdit
    {
        $this->isSortable = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEditMode(): bool
    {
        return $this->isEditMode;
    }

    /**
     * @param bool $edit
     * @return void
     */
    public function setEditMode(bool $edit)
    {
        $this->isEditMode = $edit;
    }

}
