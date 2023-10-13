<?php

namespace App\Adapters\Category;

use App\DTO\Category\CategoryUpdateDTO;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class RowCategoryAdapter extends CategoryUpdateDTO
{
    public function __construct(
        private Category $category,
    )
    {
        parent::__construct(
            id: $this->category->id,
            name: $this->category->name,
        );
    }

    /**
     * @param Category $category
     * @return self
     */
    public static function of(Category $category): self
    {
        return new self($category);
    }

    /**
     * @param Collection $category
     * @return array
     */
    public static function collection(Collection $category): array
    {
        return collect($category)->mapInto(self::class)->all();
    }
}
