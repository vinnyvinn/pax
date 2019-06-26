<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PickupRequest extends FormRequest
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
            'pickup_date' => 'required',
            'ready_time' => 'required',
            'close_time' => 'required',
            'no_packages' => 'required',
            'expected_weight' => 'required',
            'address' => 'required',
            'contact_name' => 'required',
            'contact_phone' => 'required',
            'company_name' => 'required',
            'bill_company' => 'required'
        ];
    }
}
