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

use App\Rules\StorePrice;
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
            'part_number' => 'required|max:100|unique:stores,part_number,'.$this->post('id'),
            'description' => 'required|max:255',
            'qty' => 'required|numeric|min:1',
            'location' => 'max:10',
            'price' => array('required','regex:'.$this->regex,new StorePrice()),
            'year' => 'required|numeric|between:2000,2050',
            'provider' => 'required',
            'enabled' => 'required',
            'bar_code' => 'required|max:255|unique:stores,bar_code',
        ];
    }

    public function messages()
    {
        return [
            'required' => trans('The :attribute is required'),
            'size.max' => trans('The maximum size for :attribute is :max chraracters'),
            'size.min' => trans('The minimum size for :attribute is :min'),
            'numeric' => trans('The :attribute must be numeric'),
            'unique' => trans('The :attribute is already exist'),
            'regex' => trans('The format of :attribute is not correct'),
            'between' => trans('The value of :attribute must be between 2000 and 2050'),
            'exists' => trans('This :attribute is already exist'),
        ];
    }

    public function attributes()
    {
        return [
            'part_number' => trans('Part Number'),
            'description' => trans('Description'),
            'qty' => trans('Quantity'),
            'location' => trans('Location'),
            'price' => trans('Price'),
            'year' => trans('Year'),
            'provider' => trans('Provider'),
            'enabled' => trans('Enabled'),
            'bar_code' => trans('Bar Code'),
        ];
    }

}
