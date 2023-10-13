<?php

namespace App\Services\Document;

use App\DTO\Document\DocumentDTO;
use App\DTO\Document\DocumentUpdateDTO;
use App\DTO\Document\DocumentFilterDTO;
use App\Repositories\Document\DocumentRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class DocumentService implements DocumentServiceInterface
{
    public function __construct(
        private DocumentRepositoryInterface $documentRepository,
    ) {
    }

    /**
     * @inheritdoc
     */
    public function create(DocumentDTO $data): DocumentUpdateDTO
    {
        DB::beginTransaction();

        try {
            $document = $this->documentRepository->create($data);

            DB::commit();

            return $document;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Falha ao inserir o documento:' . $e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public function update(DocumentUpdateDTO $data): DocumentUpdateDTO
    {
        DB::beginTransaction();

        try {
            $document = $this->documentRepository->update($data);

            DB::commit();

            return $document;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Falha ao atualizar o documento:' . $e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public function delete(DocumentFilterDTO $filter): void
    {
        DB::beginTransaction();

        try {
            $this->documentRepository->delete($filter);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Falha ao deletar o documento:' . $e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public function getById(DocumentFilterDTO $filter): DocumentUpdateDTO
    {
        return $this->documentRepository->getById($filter);
    }

    /**
     * @inheritdoc
     */
    public function getAll(): array
    {
        return $this->documentRepository->getAll();
    }
}
