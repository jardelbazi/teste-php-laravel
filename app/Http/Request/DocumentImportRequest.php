<?php

namespace App\Http\Request;

use App\Helpers\RequestValidator;

class DocumentImportRequest extends RequestValidator
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document' => 'required|file|mimetypes:application/json',
        ];
    }

    public function messages(): array
    {
        return [
            'document.required' => 'O arquivo é obrigatória.',
            'document.file' => 'O documento precisa ser um arquivo.',
            'document.mimetypes' => 'Tipo de arquivo inválido',
        ];
    }

}
