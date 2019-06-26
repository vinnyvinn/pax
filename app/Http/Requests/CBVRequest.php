<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CBVRequest extends FormRequest
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
                'number' => 'required|unique:cbvs,id,' . $this->cbv->id,
                'rate' => 'required',
                'date_issued' => 'required'
            ];
        }

        return [
            'number' => 'required|unique:cbvs',
            'rate' => 'required',
            'date_issued' => 'required'
        ];
    }
}
