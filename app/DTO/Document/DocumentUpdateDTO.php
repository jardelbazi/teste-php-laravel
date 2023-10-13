<?php

namespace App\DTO\Document;

class DocumentUpdateDTO extends DocumentDTO
{
    public function __construct(
        public readonly int $id,
        int $category_id,
        string $title,
        string $contents,
    ) {
        parent::__construct(
            category_id: $category_id,
            title: $title,
            contents: $contents,
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
