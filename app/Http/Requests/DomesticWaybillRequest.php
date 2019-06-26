<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomesticWaybillRequest extends FormRequest
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
           'total_package' => 'required',
            'weight' => 'required',
            'packaging' => 'required',
            'shipment_description' => 'required',
            'shipment_value' => 'required',
            'con_phone' => 'required',
            'con_name' => 'required',
            'con_address' => 'required',
            'con_address_alternate' => 'required',
            'con_city' => 'required',
        ];
    }
}