<?php

namespace App\Repositories\Category;

use App\DTO\Category\CategoryDTO;
use App\DTO\Category\CategoryFilterDTO;
use App\DTO\Category\CategoryUpdateDTO;

interface CategoryRepositoryInterface
{
    /**
     * @param CategoryDTO $data
     * @return CategoryUpdateDTO
     */
    public function create(CategoryDTO $data): CategoryUpdateDTO;

    /**
     * @param CategoryUpdateDTO $data
     * @return CategoryUpdateDTO|null
     */
    public function update(CategoryUpdateDTO $data): ?CategoryUpdateDTO;

    /**
     * @param CategoryFilterDTO $filter
     * @return void
     */
    public function delete(CategoryFilterDTO $filter): void;

    /**
     * @param CategoryFilterDTO $filter
     * @return CategoryUpdateDTO
     */
    public function getOneBy(CategoryFilterDTO $filter): CategoryUpdateDTO;

    /**
     * @return array|null
     */
    public function getAll(): ?array;
}
