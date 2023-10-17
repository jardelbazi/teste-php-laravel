<?php

namespace App\Repositories\Document;

use App\Adapters\Document\RowDocumentAdapter;
use App\DTO\Document\DocumentDTO;
use App\DTO\Document\DocumentFilterDTO;
use App\DTO\Document\DocumentUpdateDTO;
use App\Interpreters\Document\DocumentIdAttributeInterpreter;
use App\Models\Document;
use Illuminate\Contracts\Database\Eloquent\Builder;

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
    public function getOneBy(DocumentFilterDTO $filter): DocumentUpdateDTO
    {
        return RowDocumentAdapter::of(
            $this->getDocumentQuery($filter)->firstOrFail()
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

    /**
     * @param DocumentFilterDTO $filter
     * @return Builder
     */
    private function getDocumentQuery(DocumentFilterDTO $filter): Builder
    {
        $query = $this->model->query();

        $interpreters = [
            new DocumentIdAttributeInterpreter($filter),
        ];

        foreach ($interpreters as $interpreter) {
            $query = $interpreter->setQuery($query)->interpret();
        }

        return $query;
    }

    /**
     * @param DocumentDTO $data
     * @return void
     */
    public function import(DocumentDTO $data): void
    {
        $this->model->create($data->toArray());
    }
}
