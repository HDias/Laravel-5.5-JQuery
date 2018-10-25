<?php

namespace ACL\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'name'          => "required|string|max:200|unique:roles",
            'permissions_id' => "required|array",
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => 'O campo Nome é obrigatório.',
            'permissions_id.required'    => 'Selecione no mínimo 1(uma) permissão',
        ];
    }
}
