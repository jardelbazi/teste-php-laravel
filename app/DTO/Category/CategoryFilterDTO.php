<?php

namespace App\DTO\Category;

class CategoryFilterDTO
{
    public function __construct(
        public readonly ?int $id = null,
    ) {
    }
}
