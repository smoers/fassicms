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
 *  Date : 16/12/20 08:28
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReassortRequest extends FormRequest
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
        $worksheetId = config('moco.reason.worksheetId');
        return [
            'qty_add' => 'required|numeric|integer|min:1',
            'reason' => 'required',
            'note' => 'max:255|exclude_unless:reason,'.$worksheetId.'|required|exists:worksheets,number',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => trans('The :attribute is required'),
            'integer' => trans('The number of pieces added must be an integer'),
            'max' => trans('The maximum size for :attribute is :max chraracters'),
            'min' => trans('The minimum of added part is :min'),
            'numeric' => trans('The :attribute must be numeric'),
            'exists' => trans('The worksheet number is not exist')
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'qty_add' => trans('Quantity added'),
            'reason' => trans('Reason'),
            'note' => trans('note'),
        ];
    }
}
