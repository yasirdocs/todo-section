<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'id_section' => 'required',
            'name' => 'required',
            'description' => 'required',
            'state' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id_section.required' => 'Please fill the id section.',
            'name.required' => 'Please fill the name.',
            'description.required' => 'Please fill the description.',
            'state.required' => 'Please fill the state.',
        ];
    }
}
