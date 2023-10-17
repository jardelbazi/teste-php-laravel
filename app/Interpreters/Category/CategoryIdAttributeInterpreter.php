<?php

namespace App\Interpreters\Category;

use App\DTO\Category\CategoryFilterDTO;
use App\Helpers\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class CategoryIdAttributeInterpreter extends DbInterpreter
{
    public function __construct(
        private CategoryFilterDTO $filter,
    ) {
    }

    /**
     * @return Builder
     */
    public function interpret(): Builder
    {
        $id = $this->filter->id;

        if (blank($id))
            return $this->query;

        return $this->query->where('id', $id);
    }
}
