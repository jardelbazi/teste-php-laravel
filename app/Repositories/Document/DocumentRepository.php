<?php

namespace App\Repositories\Document;

use App\Adapters\Document\RowDocumentAdapter;
use App\DTO\Document\DocumentDTO;
use App\DTO\Document\DocumentFilterDTO;
use App\DTO\Document\DocumentUpdateDTO;
use App\Models\Document;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function __construct(
        protected Document $model
    ) {
    }

    /**
     * @inheritdoc
     */
    public function create(DocumentDTO $data): DocumentUpdateDTO
    {
        $document = $this->model->create($data->toArray());

        return RowDocumentAdapter::of($document);
    }

    /**
     * @inheritdoc
     */
    public function update(DocumentUpdateDTO $data): ?DocumentUpdateDTO
    {
        $document = $this->model->findOrFail($data->id);
        $document->update($data->toArray());

        return RowDocumentAdapter::of($document);
    }

    /**
     * @inheritdoc
     */
    public function delete(DocumentFilterDTO $filter): void
    {
        $this->model->findOrFail($filter->id)->delete();
    }

    /**
     * @inheritdoc
     */
    public function getById(DocumentFilterDTO $filter): DocumentUpdateDTO
    {
        return RowDocumentAdapter::of(
            $this->model->findOrFail($filter->id)
        );
    }

    /**
     * @inheritdoc
     */
    public function getAll(): array
    {
        $documents = $this->model->all();

        if (blank($documents))
            return [];

        return RowDocumentAdapter::collection($documents);
    }
}
