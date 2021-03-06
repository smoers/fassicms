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
 *  Date : 23/12/20 16:49
 */
/**
 * @param {string} options
 * @param {string} options.url
 * @param {string} options.method
 * @param {Object} options.data
  */
;(function ($) {

    $.redirect = function(options) {
        if (typeof options === 'object') {
            var $form = $("<form />");

            $form.attr("action",options.url);
            $form.attr("method",options.method);

            for (var data in options.data)
                $form.append('<input type="hidden" name="'+data+'" value="'+options.data[data]+'" />');
            $("body").append($form);
            $form.submit();
        } else {
            console.log('Le paramêtres doit être un objet')
        }
    }

    /**
     * Retourne l'objet avec les valeurs
     *
     * @param inputs
     * @returns {{}}
     */
    $.redirect.data = function (inputs) {
        var obj = {}
        for(var input in inputs)
            obj[inputs[input]] = $('#' + inputs[input]).val();
        return obj;
    }

}(window.jQuery))
