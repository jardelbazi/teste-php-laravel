<?php

namespace App\Http\Resources;

use App\DTO\Document\DocumentUpdateDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var DocumentUpdateDTO */
        $document = $this->resource;
        return $document->toArray();
    }
}
