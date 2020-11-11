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
 *  Date : 11/11/20 17:36
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 11-11-20
 */

namespace App\Moco\Criteria;


class Criterias
{
    private static $_instance = null;
    private $_filters = array();

    private function __construct()
    {
        $this->_filters = collect();
    }

    /**
     * @return Criterias|null
     */
    public static function getInstance()
    {
        if(is_null(self::$_instance)){
            self::$_instance = new Criterias();
        }
        return self::$_instance;
    }

    /**
     * @param String $criteriaName
     * @return Criteria
     */
    public function get(String $criteriaName) : Criteria
    {
        if($this->_filters->contains($criteriaName))
        {
            return $this->_filters->get($criteriaName);
        }
        else
        {
            $criteria = new Criteria();
            $this->_filters->put($criteriaName, $criteria);
            return $criteria;
        }
    }


}
