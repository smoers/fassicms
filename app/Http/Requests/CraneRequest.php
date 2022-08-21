<?php

namespace App\Http\Requests;

use App\Moco\Common\MocoFormRequestAjaxValidation;
use App\Rules\CraneUnique;
use Illuminate\Foundation\Http\FormRequest;

class CraneRequest extends FormRequest
{
    use MocoFormRequestAjaxValidation;

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
            'customer_id' => 'required',
            'customer_name' => 'required',
            'crane_id' => 'nullable',
            'truck_id' => 'nullable',
            'plate' => 'required|max:20',
            'brand' => 'nullable|max:250',
            'truck_model' => 'nullable|max:250',
            'serial' => 'required|max:20',
            'crane_model' => 'required|max:255',
            'year_production' => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'max' => trans('The maximum size for :attribute is :max characters'),
            'required' => trans('The :attribute is required'),
        ];
    }

    public function attributes()
    {
        return [
            'serial' => trans('Serial number'),
            'crane_model' => trans('Crane model'),
            'plate' => trans('Numberplate'),
            'brand' => trans('Brand'),
            'truck_model' => trans('Truck model'),
            'customer_name' => trans('Company name'),
        ];
    }
}
