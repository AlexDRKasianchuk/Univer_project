<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataRequest extends FormRequest
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
            'variant' => 'min:1|integer|required',
            'amountOfData' => 'min:2|integer|required',
            'min' => 'required',
            'max' => 'gt:min|required',
            'levelP' => 'min:1|integer',
        ];
    }
}
