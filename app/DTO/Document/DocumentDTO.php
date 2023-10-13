<?php

namespace App\DTO\Document;

use Illuminate\Contracts\Support\Arrayable;

class DocumentDTO implements Arrayable
{
    public function __construct(
        public readonly int $category_id,
        public readonly string $title,
        public readonly string $contents,
    ) {
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return [
            'category_id' => $this->category_id,
            'title' => $this->title,
            'contents' => $this->contents,
        ];
    }
}
