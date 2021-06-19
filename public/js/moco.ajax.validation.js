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
 *  Date : 28/11/20 14:36
 */

/**
 * Chargement des valeurs dans l'objet destiné à Ajax
 * @param objectFields
 * @returns {*}
 */
var loadValue = function(objectFields, index){
    if (index == null)
        index = "";
    $.each(objectFields, function (name,value){
        objectFields[name] = $('#'+name+index).val();
    });
    return objectFields;
}

/**
 *
 * @param selector
 * @param value
 * @param url
 */
var mocoAjaxValidation = function (selector,value,url) {
    $.ajax({
        url: url,
        type:"POST",
        data: value,
        success:function (response) {
            $(selector).removeClass('is-invalid').addClass('is-valid');
            $(selector+'Error').text("");
        },
        error:function (response) {
            id = $(selector).attr('id');
            message = response.responseJSON.errors[id.match(/[^\d]+/g)];
            if(message == null)
            {
                $(selector).removeClass('is-invalid').addClass('is-valid');
                $(selector+'Error').text("");
            }
            else
            {
                $(selector).removeClass('is-valid').addClass('is-invalid');
                $(selector + 'Error').text(message);
            }
        }
    })
}

/**
 * Construit l'URL
 *
 * @param action
 * @returns {string}
 */
var mocoURL = function (action) {
    let result = action.match(/[^\/]+/g);
    let url = result[0]+'//';
    for(let i=1;i<=result.length-2;i++){
        url = url + result[i]+'/';
    }
    console.log(url);
    return url;
}

/**
 * Exécuter au charge de la page
 */
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Variable
    var validationArray = [];
    var validationFields = {};
    var url = 'ajaxvalidation';

    //Constructeur
    var element = $('input, select, form');
    element.each(function (key, value) {
        if(element.eq(key).attr('moco-validation') != null || element.eq(key).attr('moco-validation-table') != null ){
            elementId = element.eq(key).attr('id');
            if(element.eq(key).prop('tagName') == 'FORM'){
                action = element.eq(key).attr('action');
                url = mocoURL(action)+url;
            } else {
                validationArray[elementId] = 0;
                if (element.eq(key).attr('moco-validation') != null) {
                    validationFields[elementId] = ""; //object pour l'ajax request
                } else if (element.eq(key).attr('moco-validation-table') != null) {
                    validationFields[elementId.match(/[^\d]+/g)] = "";
                }
            }

        }
    });

    //Set event
    $('input').on('keyup', function(event){
        targetId = (this.id);
        if(targetId != "") {
            index = targetId.match(/\d+$/g);
            clearTimeout(validationArray[targetId]);
            validationArray[targetId] = setTimeout(mocoAjaxValidation, 1000, '#' + targetId, loadValue(validationFields, index), url);
        }
    });


});

