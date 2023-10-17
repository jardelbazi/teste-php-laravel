<?php

namespace App\Interpreters\Category;

use App\DTO\Category\CategoryFilterDTO;
use App\Helpers\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class CategoryNameAttributeInterpreter extends DbInterpreter
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
        $name = $this->filter->name;

        if (blank($name))
            return $this->query;

        return $this->query->where('name', $name);
    }
}
