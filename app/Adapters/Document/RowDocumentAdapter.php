<?php

namespace App\Adapters\Document;

use App\DTO\Document\DocumentUpdateDTO;
use App\Models\Document;
use Illuminate\Database\Eloquent\Collection;

class RowDocumentAdapter extends DocumentUpdateDTO
{
    public function __construct(
        private Document $document,
    )
    {
        parent::__construct(
            id: $this->document->id,
            category_id: $this->document->category_id,
            title: $this->document->title,
            contents: $this->document->contents,
        );
    }

    /**
     * @param Document $document
     * @return self
     */
    public static function of(Document $document): self
    {
        return new self($document);
    }

    /**
     * @param Collection $document
     * @return array
     */
    public static function collection(Collection $document): array
    {
        return collect($document)->mapInto(self::class)->all();
    }
}
