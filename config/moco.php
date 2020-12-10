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
 *  Date : 10/12/20 17:58
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 10-12-20
 */

/**
 * Fichier de configuration de l'application
 *
 *   !!!! MERCI DE NE RIEN MODIFIER SOUS PEINE DE BLOQUER L'APPLICATION !!!!
 *
 */

return [

    /**
     * Sortie sur Worksheet
     */
    'reason' => [

        /**
         * La valeur des filtre utilisé pour le combo raison
         */
        'filtering' => [
            'out' => 'O',
            'reassort' => 'R',
            'all' => 'A',
        ],
        /**
         * L'id de la raison lorsque l'on fait une sortie sur
         * une fiche de travail
         */
        'worksheetId' => 6

    ],

];
