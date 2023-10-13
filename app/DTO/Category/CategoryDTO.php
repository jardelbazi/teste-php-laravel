<?php

namespace App\DTO\Category;

use Illuminate\Contracts\Support\Arrayable;

class CategoryDTO implements Arrayable
{
    public function __construct(
        public readonly string $name,
    ) {
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return [
            'name' => $this->name,
        ];
    }
}
