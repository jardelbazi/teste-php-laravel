<?php

namespace App\Services\Category;

use App\DTO\Category\CategoryDTO;
use App\DTO\Category\CategoryFilterDTO;
use App\DTO\Category\CategoryUpdateDTO;

interface CategoryServiceInterface
{
    /**
     * @param CategoryDTO $data
     * @return CategoryUpdateDTO
     */
    public function create(CategoryDTO $data): CategoryUpdateDTO;

    /**
     * @param CategoryUpdateDTO $data
     * @return CategoryUpdateDTO
     */
    public function update(CategoryUpdateDTO $data): CategoryUpdateDTO;

    /**
     * @param CategoryFilterDTO $filter
     * @return void
     */
    public function delete(CategoryFilterDTO $filter): void;

    /**
     * @param CategoryFilterDTO $filter
     * @return CategoryUpdateDTO
     */
    public function getById(CategoryFilterDTO $filter): CategoryUpdateDTO;

    /**
     * @return array
     */
    public function getAll(): array;
}
