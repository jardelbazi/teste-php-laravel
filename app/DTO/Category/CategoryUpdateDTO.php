<?php

namespace App\DTO\Category;

class CategoryUpdateDTO extends CategoryDTO
{
    public function __construct(
        public readonly int $id,
        string $name,
    ) {
        parent::__construct(
            name: $name,
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = parent::toArray();
        $array['id'] = $this->id;
        return $array;
    }
}
