<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorksheetRequest extends FormRequest
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
            'number' => 'required|numeric|integer',
            'date' => 'required|date_format:d/m/Y',
            'crane_id' => 'required',
            'customer_id' => 'required',
            'remarks' => 'nullable',
            'work' => 'nullable',
            'oil_replace' => array('nullable','regex:'.config('moco.worksheet.formatOilReplace')),
            'oil_filtered' => 'required|boolean',
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
            'date' => trans('The :attribute must be a date'),
            'date_format' => ('The format of the :attribute must be :date_format'),
            'required' => trans('The :attribute is required'),
            'numeric' => trans('The :attribute must be numeric'),
            'regex' => trans('The format of :attribute is not correct'),
            'integer' => trans('The :attribute must be an integer'),
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
            'date' => 'Date',
            'crane_id' => trans('Crane'),
            'customer_id' => trans('Customer'),
            'oil_replace' => trans('Oil replace'),
        ];
    }
}
