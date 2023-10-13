<?php

namespace App\Http\Request;

use App\Helpers\RequestValidator;

class DocumentRequest extends RequestValidator
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string|min:3|max:60',
            'contents' => 'required|string|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'A categoria do documento é obrigatória.',
            'category_id.integer' => 'A categoria do document deve ser um numero inteiro.',
            'category_id.exists' => 'Categoria :input não encontrada.',
            'title.required' => 'O título é obrigatório.',
            'title.string' => 'O título deve ser do tipo string.',
            'title.min' => 'O título deve ter mais de 3 caracteres.',
            'title.max' => 'O títuloe deve ter até 60 caracteres.',
            'contents.required' => 'O conteúdo é obrigatório.',
            'contents.string' => 'O conteúdo deve ser do tipo string.',
            'contents.min' => 'O conteúdo deve ter mais de 3 caracteres.',
        ];
    }

}
