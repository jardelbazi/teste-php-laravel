<?php

namespace App\Services\Document;

use App\DTO\Document\DocumentDTO;
use App\DTO\Document\DocumentFilterDTO;
use App\DTO\Document\DocumentUpdateDTO;
use Illuminate\Http\Request;

interface DocumentServiceInterface
{
    /**
     * @param DocumentDTO $data
     * @return DocumentUpdateDTO
     */
    public function create(DocumentDTO $data): DocumentUpdateDTO;

    /**
     * @param DocumentUpdateDTO $data
     * @return DocumentUpdateDTO
     */
    public function update(DocumentUpdateDTO $data): DocumentUpdateDTO;

    /**
     * @param DocumentFilterDTO $filter
     * @return void
     */
    public function delete(DocumentFilterDTO $filter): void;

    /**
     * @param DocumentFilterDTO $filter
     * @return DocumentUpdateDTO
     */
    public function getOneBy(DocumentFilterDTO $filter): DocumentUpdateDTO;

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param Request $request
     * @return void
     */
    public function import(Request $request);
}
