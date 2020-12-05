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
 *  Date : 5/12/20 13:33
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OutWorksheetStepRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'number' => 'required|numeric|integer|between:20200000000000,20600000000000|exists:worksheets,number'
        ];
    }

    /**
     * Get the messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => trans('The :attribute is required'),
            'numeric' => trans('The :attribute must be numeric'),
            'size' => trans('The :attribute must have a size of :size'),
            'exists' => trans('The :attribute does not exist')
        ];
    }

    /**
     * Get attributes
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'number' => trans('number of the worksheet'),
        ];
    }


}
