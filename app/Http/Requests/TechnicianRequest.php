<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnicianRequest extends FormRequest
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
            'number' => 'required|max:8',
            'lastname' => 'required|max:255',
            'firstname' => 'required|max:255',
            'enabled' => 'required',
        ];
    }

    /**
     * message par type d'erreur
     *
     * @return array
     */
    public function messages()
    {
        return [
            'max' => trans('The maximum size for :attribute is :max chraracters'),
            'required' => trans('The :attribute is required'),
        ];
    }

    /**
     * détinition des attributs
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'number' => trans('Number'),
            'lastname' => trans('Lastname'),
            'firstname' => trans('Firstname'),
            'enabled' => trans('Enabled'),
        ];
    }

}
