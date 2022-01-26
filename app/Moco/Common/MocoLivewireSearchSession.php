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
 *  Date : 23/01/22 17:39
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 23-01-22
 */

namespace App\Moco\Common;

trait MocoLivewireSearchSession
{
    /**
     * Variable par défaut qui seront sauvegardées dans la session
     * @var array|string[]
     */
    protected array $default_properties = ['search'];
    /**
     * Variable qui doivent être sauvegardées dans la session
     * @var array
     */
    private array $local_properties = [];

    /**
     * Cette méthode va chargée les variables préalablement sauvegardées dans la session.
     * Elle doit être explicitement appelée dans le constructeur
     */
    protected function loadSearchSessionValue()
    {
        if (session()->exists('MocoLivewireSearchSession')) {
            if (array_key_exists(get_class($this), session()->get('MocoLivewireSearchSession'))) {
                if (is_array($session_properties = session()->get('MocoLivewireSearchSession')[get_class($this)])) {
                    foreach ($session_properties as $property => $value) {
                        $this->$property = $value;
                    }
                }
            }
        }
    }

    public function updated()
    {
        /**
         * détermine si la propriété avec la liste des propriétés à sauvegarder existe chez le parent
         */
        if (property_exists($this,'properties') && is_array($this->properties))
            $this->local_properties = $this->properties;
        /**
         * merge les tableaux avec le variables à sauvegarder dans la session
         */
        $properties = array_merge($this->default_properties,$this->local_properties);
        /**
         * charge les propriétés de l'objet avec leur valeur
         */
        $obj_properties = get_object_vars($this);
        /**
         * tableau à enregistrer dans la session
         */
        $session_properties = [];
        /**
         * parcoure le tableau avec les propriétés à sauvegarder
         */
        foreach ($properties as $property){
            if (array_key_exists($property,$obj_properties))
                $session_properties[$property] = $obj_properties[$property];
        }
        /**
         * Enregistre dans la session
         */
        $array = session()->get('MocoLivewireSearchSession');
        $array[get_class($this)] = $session_properties;
        session()->put('MocoLivewireSearchSession',$array);
    }
}
