<?php

namespace ACL\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
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
            'name'          => "required|string|max:200|unique:permissions,name,{$this->id}",
            'readable_name' => "required|string|max:200|unique:permissions,readable_name,{$this->id}",
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => 'O campo Label é obrigatório.',
            'readable_name.required'    => 'O campo Nome é obrigatório.',
        ];
    }
}
