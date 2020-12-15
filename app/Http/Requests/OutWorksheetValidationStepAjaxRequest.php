<?php

namespace App\Http\Requests;

use App\Moco\Common\MocoFormRequestAjaxValidation;
use App\Rules\StoreQty;
use Illuminate\Foundation\Http\FormRequest;

class OutWorksheetValidationStepAjaxRequest extends FormRequest
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
            'part_number' => 'required|max:100|exists:stores,part_number',
            'qty' => ['required','numeric','min:1','integer',new StoreQty($this->getRequestArray()['part_number'])],
        ];
    }

    public function messages()
    {
        return parent::messages(); // TODO: Change the autogenerated stub
    }

    public function attributes()
    {
        return parent::attributes(); // TODO: Change the autogenerated stub
    }


}
