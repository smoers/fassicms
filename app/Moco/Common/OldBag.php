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
 *  Date : 15/11/20 19:23
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 15-11-20
 */

namespace App\Moco\Common;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class OldBag
{
    protected $collection = null;

    public function __construct()
    {
        $this->collection = new Collection();
    }

    public function load(FormRequest $formRequest)
    {
        foreach ($formRequest->all() as $key => $value){
            $this->collection->put($key,$value);
        }
    }

    public function get(String $key)
    {
        return $this->collection->get($key);
    }

}
