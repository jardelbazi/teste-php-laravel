<?php

namespace App\DTO\Document;

class DocumentFilterDTO
{
    public function __construct(
        public readonly ?int $id = null,
    ) {
    }
}
