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
     * Version release
     */
    'app' => [
        'version' => 'Version 3.2.0',
        'release' => [
            '* Modification du filtre sur la liste des fiches de travail pour ne pas afficher les fiches validées</br>* Het filter wijzigen op de lijst met werkbladen om de gevalideerde kaarten niet weer te geven',
            '* Ajout du champ année de production sur la fiche de la grue</br>* Toevoeging van het productiejaar van de productie op het vel van de kraan',
            ]
    ],
    /**
     * Regex pour le format du mot de passe
     */
    'password' => [
        'rule01' => ['regex' => '^.{8,40}$', 'msg' => 'be at least 8 characters long'],
        'rule02' => ['regex' => '[a-z]', 'msg' => 'include lower case characters'],
        'rule03' => ['regex' => '[A-Z]', 'msg' => 'include upper case characters'],
        'rule04' => ['regex' => '[0-9]', 'msg' => 'include at least one number'],
        'rule05' => ['regex' => '['.preg_quote('!"#$%&()*+,-./:;<=>?@[\]^_`{|}~','/').']', 'msg' => 'include at least one symbol @#$...'],
        ],
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
        * Pour l'impression des code bar des techniciens
        */
        'technician_list' => [
            'text_font_size' => 12,
            'margin_left' => 15,
            'margin_top' => 15,
            'margin_right' => 15,
            'footer_margin' => 25,
            'top_margin' => 5,
            'by_line' => 2,
            'inter_line' => 20,
            'align' => 'C',
            'padding_left' => 4,
            'padding_top' => 4,
            'padding_right' => 4,
            'padding_bottom' => 4,
            'type_bc' => 'C39E',
            'height_bc' => 40,
            'width_bc' => 0.2,
            'align_bc' => 'M',
        ],
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
            'customer_id' => 'customer:name|address|zipcode|city|country',
            'crane_id' => 'crane:serial|model|plate',
            'worksheet_id' => 'worksheet:number',
            'technician_id' => 'technician:firstname|lastname',
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
            ],
            'users' => [
                'name' => [
                    'id' => 'Identifier',
                    'lastname' => 'Lastname',
                    'firstname' => 'Firstname',
                    'enabled' => 'Enabled',
                    'language' => 'Language',
                    'email' => 'Email',
                    'email_verified_at' => 'Email Verified',
                    'password' => 'Password',
                    'remember_token' => 'Remenber Token',
                    'created_at' => 'Create Date',
                    'updated_at' => 'Update Date',
                ],
                'show' => [
                    'id' => true,
                    'lastname' => true,
                    'firstname' => true,
                    'enabled' => true,
                    'language' => false,
                    'email' => false,
                    'email_verified_at' => false,
                    'password' => false,
                    'remember_token' => false,
                    'created_at' => false,
                    'updated_at' => false,
                ],
            ],
            'worksheets' => [
                'name' => [
                    'id' => 'Identifier',
                    'number' => 'Number',
                    'date' => 'Date',
                    'remarks' => 'Customer remarks',
                    'work' => 'Work done',
                    'oil_filtered' => 'Oil filtered',
                    'validated' => 'Worksheets validated',
                    'validated_date' => 'Validated Date',
                    'customer_id' => 'Customer',
                    'truckscrane_id' => 'Crane',
                    'created_at' => 'Create Date',
                    'updated_at' => 'Update Date',
                    'user_id' => 'User',
                    'oil_replace' => 'Oil replaced (liter)',
                    'warranty' => 'Under warranty',
                ],
                'show' => [
                    'id' => true,
                    'number' => true,
                    'date' => true,
                    'remarks' => true,
                    'work' => true,
                    'oil_filtered' => true,
                    'validated' => true,
                    'validated_date' => true,
                    'truckscrane_id' => true,
                    'created_at' => true,
                    'updated_at' => true,
                    'user_id' => false,
                    'oil_replace' => true,
                    'warranty' => true,
                ],
            ],
            'customers' => [
                'name' => [
                    'id' => 'Identifier',
                    'name' => 'Company name',
                    'address' => 'Address',
                    'address_optional' => 'Address (optional)',
                    'city' => 'City',
                    'zipcode' => 'Zipcode',
                    'country' => 'Country',
                    'mail' => 'Email address',
                    'phone' => 'Phone',
                    'mobile' => 'Mobile',
                    'vat' => 'VAT',
                    'created_at' => 'Create Date',
                    'updated_at' => 'Update Date',
                    'user_id' => 'User',
                ],
                'show' => [
                    'id' => true,
                    'name' => true,
                    'address' => true,
                    'address_optional' => true,
                    'city' => true,
                    'zipcode' => true,
                    'country' => true,
                    'mail' => true,
                    'phone' => true,
                    'mobile' => true,
                    'vat' => true,
                    'created_at' => true,
                    'updated_at' => true,
                    'user_id' => false,
                ],
            ],
            'trucks_cranes' => [
                'name' => [
                    'id' => 'Identifier',
                    'serial' => 'Serial number',
                    'crane_model' => 'Crane model',
                    'plate' => 'Numberplate',
                    'brand' => 'Brand',
                    'truck_model' => 'Truck model',
                    'Current' => 'Current',
                    'date_current' => 'Current date',
                    'created_at' => 'Create Date',
                    'updated_at' => 'Update Date',
                    'user_id' => 'User',
                    'customer_id' => 'Customer',
                ],
                'show' => [
                    'id' => true,
                    'serial' => true,
                    'crane_model' => true,
                    'plate' => true,
                    'brand' => true,
                    'truck_model' => true,
                    'created_at' => true,
                    'updated_at' => true,
                    'user_id' => false,
                    'customer_id' => true,
                ],
            ],
            'technicians' => [
                'name' => [
                    'id' => 'Identifier',
                    'number' => 'Number',
                    'lastname' => 'Lastname',
                    'firstname' => 'Firstname',
                    'enabled' => 'Enabled',
                    'user_id' => 'User',
                    'created_at' => 'Create Date',
                    'updated_at' => 'Update Date',
                ],
                'show' => [
                    'id' => true,
                    'number' => true,
                    'lastname' => true,
                    'firstname' => true,
                    'enabled' => true,
                    'user_id' => false,
                    'created_at' => true,
                    'updated_at' => true,
                ],
            ],
            'clockings' => [
                'name' => [
                    'id' => 'Identifier',
                    'date' => 'Date',
                    'start_date' => 'Start date',
                    'stop_date' => 'Stop date',
                    'technician_id' => 'Technician',
                    'user_id' => 'User',
                    'created_at' => 'Create Date',
                    'updated_at' => 'Update Date',
                    'worksheet_id' => 'Worksheet',
                ],
                'show' => [
                    'id' => true,
                    'date' => true,
                    'start_date' => true,
                    'stop_date' => true,
                    'technician_id' => true,
                    'user_id' => false,
                    'created_at' => true,
                    'updated_at' => true,
                    'worksheet_id' => true,
                ],
            ],
            'parts' => [
                'name' => [
                    'id' => 'Identifier',
                    'part_number' => 'Part Number',
                    'description' => 'Description',
                    'qty' => 'Quantity',
                    'price' => 'Price',
                    'year' => 'Year',
                    'user_id' => 'User',
                    'created_at' => 'Create Date',
                    'updated_at' => 'Update Date',
                    'worksheet_id' => 'Worksheet',
                    'location_id' => 'Location',
                    'bar_code' => 'Bar Code',
                    'type' => 'Type',
                ],
                'show' => [
                    'id' => true,
                    'part_number' => true,
                    'description' => true,
                    'qty' => true,
                    'price' => true,
                    'year' => true,
                    'user_id' => true,
                    'created_at' => true,
                    'updated_at' => true,
                    'worksheet_id' => true,
                    'location_id' => true,
                    'bar_code' => true,
                    'type' => true,
                ],
            ],
            'viewparttotal' => [
                'name' => [
                    'worksheet_id' => 'Worksheet',
                    'part_number' => 'Part Number',
                    'bar_code' => 'Bar Code',
                    'qty' => 'Quantity',
                    'price' => 'Price',
                    'price_total' => 'Total Price',
                    'updated_at' => 'Update Date',
                ],
                'show' => [],
            ],
            'catalogs' => [
                'name' => [
                    'id' => 'Identifier',
                    'price' =>'Price',
                    'year' => 'Year',
                    'provider_id' => 'Provider',
                    'created_at' => 'Create Date',
                    'updated_at' => 'Update Date',
                    'partmetadata_id' => 'Partmetadata',
                    'user_id' => 'User',
                ],
                'show' => [],
            ],
        ],
    ],
    'datatable' => [
        'report' => [
            1 => [
                'view' => 'report.partmetadata-export-data-table',
                'title' => 'Reporting from Part Metadata',
            ],
            2 => [
                'view' => 'report.report-truckscrane-history',
                'title' => 'Reporting Crane History'
            ],
            3 => [
                'view' => 'report.report-stock-reassortment',
                'title' => 'Reassortment List',
            ],
            4 => [
                'view' => 'report.report-worksheets-clockings',
                'title' => 'Worksheets Clockings List'
            ],
        ],
        'fields' => [
            'excluded' => [
                'id',
                'created_at',
                'updated_at',
                'location_id',
                'provider_id',
                'user_id',
                'customer_id',
                'crane_id',
                'worksheet_id',
                'technician_id',
                'partmetadata_id'
            ]
        ]
    ]
 ];
