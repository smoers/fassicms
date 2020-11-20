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
 *  Date : 15/11/20 15:01
 */

/**
 * Company : Fassi Belgium
 * Developer : MO Consult
 * Authority : Moers Serge
 * Date : 15-11-20
 */

namespace App\Http\Requests;

use \Illuminate\Foundation\Http\FormRequest;

class StorePartRequest extends FormRequest
{

    protected $regex = '/^(?=.+)(?:[1-9]\d*|0)?(?:\,\d+)?$/';

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
            'part_number' => 'required|max:100|unique:stores,part_number',
            'description' => 'required|max:255',
            'qty' => 'required|numeric|min:1',
            'location' => 'max:10',
            'price' => array('required','regex:'.$this->regex,"min:0"),
            'year' => 'required|numeric|between:2000,2050',
            'provider' => 'required',
            'enabled' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'part_number.required' => trans('The part number is required'),
            'part_number.size' => trans('The maximum size for a part number is 100 characters'),
            'part_number.unique' => trans('This part number is already exist.'),
            'description.required' => trans('The part number description is required'),
            'description.size' => trans('The maximum size for a description is 255 characters'),
            'qty.required' => trans('The quantity is required'),
            'location.size' => trans('The maximum size for a location is 10 characters'),
            'price.required' => trans('The price is required'),
            'price.regex' => trans('The format of the price is not correct'),
            'year.required' => trans('The year is required'),
            'enabled.required' => trans('The activition is required'),
            'provider' => trans('The provider is required'),
        ];
    }

}
