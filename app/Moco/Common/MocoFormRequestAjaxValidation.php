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
 *  Date : 5/12/20 17:32
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 05-12-20
 */

namespace App\Moco\Common;

trait MocoFormRequestAjaxValidation
{
    public $requestArray;

    /**
     * @param array $request
     */
    public function setRequestArray(array $requestArray): void
    {
        $this->requestArray = $requestArray;
    }

    /**
     * @return array
     */
    public function getRequestArray()
    {
        return $this->requestArray;
    }
}
