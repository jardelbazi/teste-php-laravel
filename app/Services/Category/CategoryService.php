<?php

namespace App\Services\Category;

use App\DTO\Category\CategoryDTO;
use App\DTO\Category\CategoryUpdateDTO;
use App\DTO\Category\CategoryFilterDTO;
use App\Repositories\Category\CategoryRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
    ) {
    }

    /**
     * @inheritdoc
     */
    public function create(CategoryDTO $data): CategoryUpdateDTO
    {
        DB::beginTransaction();

        try {
            $category = $this->categoryRepository->create($data);

            DB::commit();

            return $category;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Falha ao inserir a categoria:' . $e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public function update(CategoryUpdateDTO $data): CategoryUpdateDTO
    {
        DB::beginTransaction();

        try {
            $category = $this->categoryRepository->update($data);

            DB::commit();

            return $category;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Falha ao atualizar a categoria:' . $e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public function delete(CategoryFilterDTO $filter): void
    {
        DB::beginTransaction();

        try {
            $this->categoryRepository->delete($filter);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Falha ao deletar a categoria:' . $e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public function getById(CategoryFilterDTO $filter): CategoryUpdateDTO
    {
        return $this->categoryRepository->getById($filter);
    }

    /**
     * @inheritdoc
     */
    public function getAll(): array
    {
        return $this->categoryRepository->getAll();
    }
}
