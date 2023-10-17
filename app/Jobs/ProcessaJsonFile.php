<?php

namespace App\Jobs;

use App\DTO\Category\CategoryFilterDTO;
use App\DTO\Document\DocumentDTO;
use App\Repositories\Document\DocumentRepositoryInterface;
use App\Services\Category\CategoryServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ProcessaJsonFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected string $filePath
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $jsonContent = Storage::get($this->filePath);
        $jsonData = json_decode($jsonContent);

        $categoryId = fn($category) => $this->getCategoryService()->getOneBy(new CategoryFilterDTO(name: $category));

        foreach ($jsonData->documentos as $data) {
            $document['category_id'] = $categoryId($data->categoria)->id;
            $document['title'] = $data->titulo;
            $document['contents'] = $data->conteúdo;

            $documentDTO = new DocumentDTO(
                category_id: $categoryId($data->categoria)->id,
                title: $data->titulo,
                contents: $data->conteúdo,
            );

            $this->getDocumentRepository()->import($documentDTO);
        }
    }

    private function getCategoryService(): CategoryServiceInterface
    {
        return App::make(CategoryServiceInterface::class);
    }

    private function getDocumentRepository(): DocumentRepositoryInterface
    {
        return App::make(DocumentRepositoryInterface::class);
    }
}
