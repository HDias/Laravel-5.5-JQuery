<?php

namespace ACL\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * CreateStudentRequest constructor.
     */
    public function __construct()
    {
        $cpf = preg_replace("/\D+/", "", app('request')->cpf);
        app('request')->request->set('cpf', $cpf);
    }

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
            'roles' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'cpf' => 'required|string|max:11|unique:people',
            'dt_birth' => 'required|date_format:d/m/Y',
            'sexo' => 'required|integer|max:4'
        ];
    }
}
