<?php

namespace App\Http\Controllers\Api;

use App\Adapters\Document\RequestDocumentAdapter;
use App\Adapters\Document\RequestDocumentFilterAdapter;
use App\Adapters\Document\RequestDocumentUpdateAdapter;
use App\Helpers\CollectionPaginator;
use App\Http\Controllers\Controller;
use App\Http\Request\DocumentRequest;
use App\Http\Resources\DocumentResource;
use App\Services\Document\DocumentServiceInterface;
use App\Traits\HttpApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DocumentController extends Controller
{
    use HttpApiTrait;

    public function __construct(
        private DocumentServiceInterface $documentService,
    ) {
    }

    /**
     * @param DocumentRequest $request
     * @return JsonResponse
     */
    public function store(DocumentRequest $request): JsonResponse
    {
        $content = new DocumentResource(
            $this->documentService->create(new RequestDocumentAdapter($request))
        );

        return $this->respond($content, Response::HTTP_CREATED);
    }

    /**
     * @param DocumentRequest $request
     * @return JsonResponse
     */
    public function update(DocumentRequest $request): JsonResponse
    {
        $content = new DocumentResource(
            $this->documentService->update(new RequestDocumentUpdateAdapter($request))
        );

        return $this->respond($content);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $this->documentService->delete(new RequestDocumentFilterAdapter($request));

        return $this->respond([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $content = new DocumentResource(
            $this->documentService->getById(new RequestDocumentFilterAdapter($request))
        );

        return $this->respond($content);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return DocumentResource::collection(
            resource: CollectionPaginator::paginate($this->documentService->getAll())
        );
    }
}
