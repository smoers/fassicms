<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OutRequest extends FormRequest
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
            'qty_before' => 'required|numeric|integer',
            'qty_pull' => 'required|numeric|integer|min:1|lte:qty_before',
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
            'exists' => trans('The worksheet number is not exist'),
            'lte' => trans('The number of parts issued must be less than or equal to the number of parts in stock'),
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
            'qty_pull' => trans('Quantity added'),
            'reason' => trans('Reason'),
            'note' => trans('note'),
        ];
    }
}
