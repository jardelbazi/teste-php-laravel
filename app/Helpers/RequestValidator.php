<?php

namespace App\Helpers;

use Illuminate\Foundation\Http\FormRequest;

abstract class RequestValidator extends FormRequest
{
    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->route('id') ?? null;
    }

     /**
     * @return bool
     */
    abstract public function authorize(): bool;

    /**
     * @return array
     */
    abstract public function rules(): array;
}
