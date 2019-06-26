<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HscodesRequest extends FormRequest
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
            'code'=>'required',
            'description'=>'required',
            'unit_of_qty'=>'required',
            'rate'=>'required'
        ];
    }
}
