<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomesticLocationRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            return [
                'name' => 'required|unique:domestic_locations,name,' . $this->domestic_location
            ];
        }

        return [
            'name' => 'required|unique:domestic_locations'
        ];
    }
}
