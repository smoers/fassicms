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
use Illuminate\Validation\Rule;

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
            'part_number' => ['required','max:100',Rule::unique('partmetadatas')->ignore($this->id)],
            'description' => 'required|max:255',
            'qty' => 'sometimes|required|numeric|min:1',
            'price' => array('required','regex:'.$this->regex,new StorePrice()),
            'year' => 'required|numeric|between:2000,2050',
            'provider' => 'required',
            'enabled' => 'required',
            'bar_code' => ['required','max:255',Rule::unique('partmetadatas')->ignore($this->id)],
            'reassort_level' => 'numeric|min:1|nullable',
            'location_id' => 'sometimes|required',
            'electrical_part' => 'required',
            'new_provider_name' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'required' => trans('The :attribute is required'),
            'max' => trans('The maximum size for :attribute is :max chraracters'),
            'min' => trans('The minimum size for :attribute is :min'),
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
            'reassort_level' => trans('Reassort Level'),
            'location_id' => trans('Location'),
            'electrical_part' => trans('Electrical Part'),
        ];
    }

}
