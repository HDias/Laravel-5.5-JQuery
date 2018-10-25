<?php

namespace Select\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionRequest extends FormRequest
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
            'description' => "required|string|max:255",
            'slug' => "required|string|max:255",
            'label' => "required|string|max:255",
            'order' => "nullable|integer",
        ];
    }
}
