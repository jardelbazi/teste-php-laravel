<?php

namespace App\Http\Controllers\Api;

use App\Adapters\Category\RequestCategoryAdapter;
use App\Adapters\Category\RequestCategoryFilterAdapter;
use App\Adapters\Category\RequestCategoryUpdateAdapter;
use App\Helpers\CollectionPaginator;
use App\Http\Controllers\Controller;
use App\Http\Request\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\Category\CategoryServiceInterface;
use App\Traits\HttpApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    use HttpApiTrait;

    public function __construct(
        private CategoryServiceInterface $categoryService,
    ) {
    }

    /**
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $content = new CategoryResource(
            $this->categoryService->create(new RequestCategoryAdapter($request))
        );

        return $this->respond($content, Response::HTTP_CREATED);
    }

    /**
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function update(CategoryRequest $request): JsonResponse
    {
        $content = new CategoryResource(
            $this->categoryService->update(new RequestCategoryUpdateAdapter($request))
        );

        return $this->respond($content);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $this->categoryService->delete(new RequestCategoryFilterAdapter($request));

        return $this->respond([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $content = new CategoryResource(
            $this->categoryService->getOneBy(new RequestCategoryFilterAdapter($request))
        );

        return $this->respond($content);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(
            resource: CollectionPaginator::paginate($this->categoryService->getAll())
        );
    }
}
