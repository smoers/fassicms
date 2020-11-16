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

use App\Moco\Common\OldBag;
use http\Client\Request;
use Illuminate\Contracts\Session\Session;
use \Illuminate\Foundation\Http\FormRequest;
use Illuminate\Session\SessionManager;

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
            'qty' => 'required|numeric',
            'location' => 'max:10',
            'price' => array('required','regex:'.$this->regex),
            'year' => 'required|numeric|between:2000,2050',
            'provider' => 'required',
            'enabled' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'part_number.required' => 'The part number is required',
            'part_number.size' => 'The maximum size for a part number is 100 characters',
            'part_number.unique' => 'This part number is already exist.',
            'description.required' => 'The part number description is required',
            'description.size' => 'The maximum size for a description is 255 characters',
            'qty.required' => 'The quantity is required',
            'location.size' => 'The maximum size for a location is 10 characters',
            'price.required' => 'The price is required',
            'price.regex' => 'The format of the price is not correct',
            'year.required' => 'The year is required',
            'enabled.required' => 'The activition is required',
            'provider' => 'The provider is required',
        ];
    }

    /**
     * Configure the validator instance.
     * Recrée la function old() car il y a des problèmes si on
     * combine Livewire validation online et un controller
     *
     * @param  \Illuminate\Validation\Validator $validator
     *
     * @return void
     */
    public function withValidator( $validator )
    {
        $oldBag =new OldBag();
        $oldBag->load($this);
        $this->session()->flash('oldBag',$oldBag);
    }


}
