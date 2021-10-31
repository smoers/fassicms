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

class Column
{
    protected string $name;
    protected string $attribute;
    protected $formatCallback;
    protected ?FilterInterface $filterObject = null;

    /**
     * @param string $name
     * @param string $attribute
     */
    public function __construct(string $name, string $attribute)
    {
        $this->name = $name;
        $this->attribute = $attribute;
    }

    /**
     * @param string $name
     * @param string $attribute
     * @return Column
     */
    public static function make(string $name, string $attribute): Column
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
    public function getAttribute(): string
    {
        return $this->attribute;
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
     * @return bool
     */
    public function isFormatted(): bool
    {
        return is_callable($this->formatCallback);
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

}
