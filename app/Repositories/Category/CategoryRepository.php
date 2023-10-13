<?php

namespace App\Repositories\Category;

use App\Adapters\Category\RowCategoryAdapter;
use App\DTO\Category\CategoryDTO;
use App\DTO\Category\CategoryFilterDTO;
use App\DTO\Category\CategoryUpdateDTO;
use App\Models\Category;

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
    public function getById(CategoryFilterDTO $filter): CategoryUpdateDTO
    {
        return RowCategoryAdapter::of(
            $this->model->findOrFail($filter->id)
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
}
