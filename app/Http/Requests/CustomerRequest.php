<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required|max:100|unique:customers,name,'.$this->post('id'),
            'address' => 'required|max:100',
            'address_optional' => 'max:100',
            'city' => 'required|max:50',
            'zipcode' => 'required|max:10',
            'country' => 'required|max:100',
            'mail' => 'nullable|email|max:100',
            'phone' => 'max:100',
            'mobile' => 'max:100',
            'vat' => 'max:15',
            'black_listed' => 'required',
            'contacts.id.*' => 'nullable',
            'contacts.firstname.*' => 'nullable|max:255',
            'contacts.lastname.*' => 'required|max:255',
            'contacts.function.*' => 'nullable|max:255',
            'contacts.phone.*' => 'nullable|max:100',
            'contacts.mobile.*' => 'nullable|max:100',
        ];
    }

    public function messages()
    {
        return [
            'required' => trans('The field :attribute is required'),
            'size' => trans('The maximum size for :attribue is :max')
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('Company name'),
            'address' => trans('Address'),
            'address_optional' => trans('Address (optional)'),
            'city' => trans('City'),
            'zipcode' => trans('Zipcode'),
            'country' => trans('Country'),
            'mail' => ('Email address'),
            'phone' => ('Phone number'),
            'mobile' => ('Mobile number'),
            'vat' => trans('VAT'),
            'black_listed' => trans('Black listed'),
            'contacts.firstname.*' => trans('Contact firstname'),
            'contacts.lastname.*' => trans('Contact lastname'),
            'contacts.function.*' => trans('Contact function'),
            'contacts.phone.*' => trans('Contact phone number'),
            'contacts.mobile.*' => trans('Contact mobile number'),
        ];
    }
}
