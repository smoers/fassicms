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
        'worksheetId' => 6,
        /**
         * L'id de la raison lorsque l'on crée une nouvelle piècé
         */
        'newId' => 8,
    ],

    /**
     * Store
     */
    'store' => [
        /**
         * Valeur minimum du prix d'une pièce
         */
        'minPrice' => 0.01,
    ],

    /**
     * Réassortiment et sortie de stock
     */
    'reassort' => [
        /**
         * Valeur par défaut de l'emplacement dans l'entête de la liste des pièces en stock
         */
        'defaultLocation' => 2,
        /**
         * Id de la raison pour un mouvement depuis une autre location
         */
        'moveFrom' => 10,
        /**
         * Id de la raison pour un mouvement vers une autre location
         */
        'moveTo' => 9,
    ],

    /**
     * Worksheet
     */
    'worksheet' => [
        /**
         * Format du champ oil_replace
         */
        'formatOilReplace' => '/^(?=.+)(?:[1-9]\d*|0)?(?:\,\d+)?$/',

    ],

    /**
     * Tableau avec les listes
     */
    'table' => [
        /**
         * Nombre par défaut d'item par page
         */
        'perPage' => 10,
        /**
         * Nombre d'item possible par page
         */
        'perPageOptions' => [10,15,20,25,30,35,40,45,50],
        /**
         * Les classes pour le format de la ligne 'class1 class2 ...'
         */
        'rowClass' => 'moco-row-table-font-small',

    ],

    /**
     * Print parametres
     */
    'print' => [
        /**
         * Adresse pour les documents à imprimer
         */
        'address' => "FASSI BE sa/nv\n\rAvenue de l'espèrence, 68\n\rB-6220 Fleurus\n\rTél : +32 (0)71 43 43 35",
        /**
         * email
         */
        'email' => 'administration@fassibelgium.be',
        /**
         * tva
         */
        'tva' => 'BE 0885 856 557',
        /**
         * compte bancaire
         */
        'bank_account_1' => 'BNP Paribas Fortis BE24 0015 0849 9338',
        /**
         * paramêtres pour les codes barre
         */
        'barcode' => [
            /**
             * Style à utiliser
             */
            'style' => [
                'position' => '',
                'align' => 'C',
                'stretch' => true,
                'fitwidth' => false,
                'cellfitalign' => '',
                'border' => false, // border
                'hpadding' => 'auto',
                'vpadding' => 'auto',
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => false, //array(255,255,255),
                'text' => true, // whether to display the text below the barcode
                'font' => 'helvetica', //font
                'fontsize' => 6, //font size
                'stretchtext' => 6,
                'label' => '',
            ]
        ]
    ],
    /**
     * flag pour les enregistrement clocking details
     */
    'clocking' => [
        'actions' => [
            'start' => 'T',
            'stop' => 'P',
        ],
        'status' => [
            'activated' => 'A',
            'deleted' => 'D',
            'register' => 'R',
        ]
    ],
    /**
     * ce sont la liste des champs contenus dans le tables
     * utilisé pour construire l'interface Consult
     */
    'consult' => [
        'follow' => [
            'location_id' => 'location:location|description',
            'provider_id' => 'provider:name',
            'user_id' => 'user:firstname|lastname',
        ],
        'fields' => [
            'partmetadatas' => [
                'name' => [
                    'id' => 'Identifier',
                    'part_number' => 'Part Number',
                    'description' => 'Description',
                    'enabled' => 'Enabled',
                    'electrical_part' => 'Electrical Part',
                    'bar_code' => 'BarCode',
                    'created_at' => 'Created Date',
                    'updated_at' => 'Updated Date',
                    'reassort_level' => 'Reassortment Level',
                    'user_id' => 'User Identifier'
                ],
                'show' => [
                    'id' => true,
                    'part_number' => true,
                    'description' => true,
                    'enabled' => true,
                    'electrical_part' => true,
                    'bar_code' => true,
                    'created_at' => true,
                    'updated_at' => true,
                    'reassort_level' => true,
                    'user_id' => false,
                ],
            ],
            'stores' => [
                'name' => [
                    'id' => 'Identifier',
                    'qty' => 'Quantity',
                    'created_at' => 'Created Date',
                    'updated_at' => 'Updated Date',
                    'location_id' => 'Location Identifier',
                    'partmetadata_id' => 'Partmetadata Identifier',
                    'user_id' => 'User Identifier',
                ],
                'show' => [
                    'id' => true,
                    'qty' => true,
                    'created_at' => true,
                    'updated_at' => true,
                    'location_id' => true,
                    'partmetadata_id' => false,
                    'user_id' => false,
                ],
            ]
        ],
    ],
 ];
