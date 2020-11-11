<?php
/*
 * Copyright (c) 2020. MO Consult
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
 *  Date : 11/11/20 17:41
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 11-11-20
 */

namespace App\Moco\Criteria;


class Criteria
{
    private $attributes = null;

    /**
     * Criteria constructor.
     */
    public function __construct()
    {
        $this->attributes = collect();
    }

    /**
     * @param String $key
     * @param $value
     */
    public function put(String $key, $value) :void
    {
        $this->attributes->put($key, $value);
    }

    /**
     * @param String $key
     * @return mixed
     */
    public function get(String $key)
    {
        return $this->attributes->get($key);
    }
}
