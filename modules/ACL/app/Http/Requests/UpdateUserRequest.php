<?php

namespace ACL\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    private $userId;

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
        // Id da tabela de people para validar o cpf
        $peopleId = app('model.person')->where('user_id', $this->id)->first()->id;
        return [
            'name' => 'required|string|min:3|max:255',
            'cpf' => "required|string|max:11|unique:people,cpf,{$peopleId}",
            'email' => "required|string|email|max:255|unique:users,email,{$this->id}",
            'dt_birth' => 'required|date_format:d/m/Y',
            'sexo' => 'required|integer|max:4',
            'password' => 'sometimes|nullable|string|min:6|confirmed',
        ];
    }
}
