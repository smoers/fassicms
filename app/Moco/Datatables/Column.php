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
 *  Date : 26/10/21 18:34
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 26-10-21
 */

namespace App\Moco\Datatables;


use App\Moco\Datatables\Filters\FilterInterface;
use App\Moco\Datatables\Traits\RandomKey;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Column
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
     * @var
     */
    protected $formatCallback;
    /**
     * @var
     */
    protected $exportFormatCallback;
    /**
     * @var FilterInterface|null
     */
    protected ?FilterInterface $filterObject = null;
    /**
     * @var bool
     */
    protected bool $isSortable = false;
    /**
     * @var string|null
     */
    protected ?string $exportFormat = null;

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
    public static function make(string $name, ?string $attribute = null): Column
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


    /**
     * @return mixed
     */
    public function getFormatCallback()
    {
        return $this->formatCallback;
    }

    /**
     * @param callable $callable
     * @return $this
     */
    public function format(callable $callable): Column
    {
        $this->formatCallback = $callable;

        return $this;
    }

    /**
     * @param callable $callable
     * @return $this
     */
    public function exportFormat(callable $callable): Column
    {
        $this->exportFormatCallback = $callable;

        return $this;
    }

    /**
     * @return $this
     */
    public function formatYesNo()
    {
        $this->format(function (Model $model, Column $column){
            return $model[$column->getAlias()] == 1 ? trans('Yes') : trans('No');
        });

        return $this;
    }

    public function formatDate()
    {
        $this->format(function (Model $model, Column $column){
            return !is_null($model[$this->getAlias()]) ? Carbon::parse($model[$this->getAlias()])->format('d/m/Y') : null;
        });

        return $this;
    }

    /**
     * @return bool
     */
    public function isFormatted(): bool
    {
        return is_callable($this->formatCallback);
    }

    /**
     * @return bool
     */
    public function isExportFormatted(): bool
    {
        return is_callable($this->exportFormatCallback);
    }

    /**
     * @param $model
     * @param $column
     *
     * @return mixed
     */
    public function formatted($model, $column)
    {
        return app()->call($this->formatCallback, ['model' => $model, 'column' => $column]);
    }

    /**
     * @param $row
     * @param $column
     * @return mixed
     */
    public function exportFormatted($row, $column)
    {
        return app()->call($this->exportFormatCallback,['row' => $row, 'column' => $column]);
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
    public function setFilter(FilterInterface $filter): Column
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
    public function setSortable(): Column
    {
        $this->isSortable = true;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getExportFormat(): ?string
    {
        return $this->exportFormat;
    }

    /**
     * @param string|null $exportFormat
     * @return Column
     */
    public function setExportFormat(?string $exportFormat): Column
    {
        $this->exportFormat = $exportFormat;
        return $this;
    }



}
