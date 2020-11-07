<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CraneStoreRequest extends FormRequest
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
            'serial' => 'required|max:20',
            'model' => 'required|max:255',
            'plate' => 'max:20'
        ];
    }

    public function messages()
    {
        return [
            'serial.required' => 'The serial number of the crane is required',
            'serial.size' => 'The maximum size for a serial is 20 characters',
            'model.required' => 'The model of the crane is required',
            'model.size' => 'The maximum size for a model is 255 characters',
            'plate.size' => 'The maximum size for a numberplate is 20 characters'

        ];
    }


}
