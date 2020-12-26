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
            'serial' => ['required','max:20',new CraneUnique($this->getRequestArray())],
            'model' => 'required|max:255',
            'plate' => ['required','max:20',new CraneUnique($this->getRequestArray())]
        ];
    }

    public function messages()
    {
        return [
            'max' => trans('The maximum size for :attribute is :max chraracters'),
            'required' => trans('The :attribute is required'),
        ];
    }

    public function attributes()
    {
        return [
            'serial' => trans('Serial number'),
            'model' => trans('Model'),
            'plate' => trans('Numberplate'),
        ];
    }
}
