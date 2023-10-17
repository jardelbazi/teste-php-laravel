<?php

namespace App\Repositories\Category;

use App\Adapters\Category\RowCategoryAdapter;
use App\DTO\Category\CategoryDTO;
use App\DTO\Category\CategoryFilterDTO;
use App\DTO\Category\CategoryUpdateDTO;
use App\Interpreters\Category\CategoryIdAttributeInterpreter;
use App\Interpreters\Category\CategoryNameAttributeInterpreter;
use App\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        protected Category $model
    ) {
    }

    /**
     * @inheritdoc
     */
    public function create(CategoryDTO $data): CategoryUpdateDTO
    {
        $category = $this->model->create($data->toArray());

        return RowCategoryAdapter::of($category);
    }

    /**
     * @inheritdoc
     */
    public function update(CategoryUpdateDTO $data): ?CategoryUpdateDTO
    {
        $category = $this->model->findOrFail($data->id);
        $category->update($data->toArray());

        return RowCategoryAdapter::of($category);
    }

    /**
     * @inheritdoc
     */
    public function delete(CategoryFilterDTO $filter): void
    {
        $this->model->findOrFail($filter->id)->delete();
    }

    /**
     * @inheritdoc
     */
    public function getOneBy(CategoryFilterDTO $filter): CategoryUpdateDTO
    {
        return RowCategoryAdapter::of(
            $this->getCategoryQuery($filter)->firstOrFail()
        );
    }

    /**
     * @inheritdoc
     */
    public function getAll(): array
    {
        $categorys = $this->model->all();

        if (blank($categorys))
            return [];

        return RowCategoryAdapter::collection($categorys);
    }

    /**
     * @param CategoryFilterDTO $filter
     * @return Builder
     */
    private function getCategoryQuery(CategoryFilterDTO $filter): Builder
    {
        $query = $this->model->query();

        $interpreters = [
            new CategoryIdAttributeInterpreter($filter),
            new CategoryNameAttributeInterpreter($filter),
        ];

        foreach ($interpreters as $interpreter) {
            $query = $interpreter->setQuery($query)->interpret();
        }

        return $query;
    }
}
