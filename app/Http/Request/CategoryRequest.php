<?php

namespace App\Http\Request;

use App\Helpers\RequestValidator;

class CategoryRequest extends RequestValidator
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome da categoria é obrigatório.',
            'name.string' => 'O nome da categoria deve ser do tipo string.',
            'name.min' => 'O campo nome da categoria deve ter mais de 3 caracteres.',
            'name.max' => 'O campo nome da categoria deve ter até 20 caracteres.',
        ];
    }

}
