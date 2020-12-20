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
 *  Date : 19/12/20 15:23
 */

/**
 *
 * @type {{select: (function(*): {data: {subtext: string}, disabled: boolean, text: string, value: string}), data: [], preprocessData: (function(*=): []), log: number, language: string, locale: (function(): ({searchPlaceholder: string, currentlySelected: string, errorText: string, statusInitialized: string, emptyTitle: string, statusTooShort: string, statusNoResults: string, statusSearching: string}|undefined)), ajax: {data: string, dataType: string, type: string, url: string}, value: []}}
 */
var selectPickerOtions = {
    ajax          : {
        url     : '',
        type    : 'POST',
        dataType: 'json',
        data    :  '',
    },
    locale      : {},
    language    : function(lg){
        if(lg == 'fr') {

            /**
             * Traduction en français (defaut)
             */
            this.locale = {
                currentlySelected: "Actuellement sélectionné",
                emptyTitle: "Sélectionnez et commencez à taper",
                errorText: "Impossible de récupérer les résultats",
                searchPlaceholder: "Chercher...",
                statusInitialized: "Commencez à taper une requête de recherche",
                statusNoResults: "Aucun résultat",
                statusSearching: "Recherche...",
                statusTooShort: "Veuillez saisir plus de caractères",
            }
        } else if(lg == 'nl'){

            /**
             * Traduction en neerlandais
             */
            this.locale = {
                currentlySelected: "Momenteel geselecteerd",
                emptyTitle: "Selecteer en begin met typen",
                errorText: "Resultaten kunnen niet worden opgehaald",
                searchPlaceholder: "Zoeken...",
                statusInitialized: "Begin met het typen van een zoekopdracht",
                statusNoResults: "Geen resultaat",
                statusSearching: "Zoeken...",
                statusTooShort: "Voer alstublieft meer karakters in",
            }
        }
    },
    log           : 3,
    /**
     * Retour de la requète Ajax
     */
    _data          : [],
    /**
     * Object avec les informations à afficher dans le select
     * @param obj
     * @returns {{data: {subtext: string}, disabled: boolean, text: string, value: string}}
     */
    select        : function(obj){
            return {
                'value': '',
                'text': '',
                'data': {
                    'subtext': '',
                },
                'disabled': false,
            }
        },
    /**
     *
     */
    _value: [],
    /**
     * Traitement des données avant l'utilisation dans le select
     * @param data
     * @returns {[]}
     */
    preprocessData: function (data) {
        this.plugin.options._value = [];
        this.plugin.options._data = data;
        for(var i=0;i<data.length;i++){
            this.plugin.options._value.push(this.plugin.options.select(data[i]));
        };
        return this.plugin.options._value;
    }
};



