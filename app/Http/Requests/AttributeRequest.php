<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
            'code' => ['required', 'min:3', 'string', Rule::unique('attributes')->ignore($this->attribute)],
            'name' => ['required', 'min:3', 'string'],
            'frontend_type' => ['required', 'not_in:0']
        ];
    }
}
