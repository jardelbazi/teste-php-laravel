<?php

namespace App\Repositories\Document;

use App\DTO\Document\DocumentDTO;
use App\DTO\Document\DocumentFilterDTO;
use App\DTO\Document\DocumentUpdateDTO;

interface DocumentRepositoryInterface
{
    /**
     * @param DocumentDTO $data
     * @return DocumentUpdateDTO
     */
    public function create(DocumentDTO $data): DocumentUpdateDTO;

    /**
     * @param DocumentUpdateDTO $data
     * @return DocumentUpdateDTO|null
     */
    public function update(DocumentUpdateDTO $data): ?DocumentUpdateDTO;

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
     * @param DocumentDTO $data
     * @return void
     */
    public function import(DocumentDTO $data): void;
}
