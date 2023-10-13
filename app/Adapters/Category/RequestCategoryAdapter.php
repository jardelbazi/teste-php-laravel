<?php

namespace App\Adapters\Category;

use App\DTO\Category\CategoryDTO;
use Illuminate\Http\Request;

class RequestCategoryAdapter extends CategoryDTO
{
    public function __construct(
        private Request $request
    ) {
        parent::__construct(
            name: $this->request->input('name'),
        );
    }
}
