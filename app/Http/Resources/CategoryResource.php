<?php

namespace App\Http\Resources;

use App\DTO\Category\CategoryUpdateDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var CategoryUpdateDTO */
        $category = $this->resource;
        return $category->toArray();
    }
}
