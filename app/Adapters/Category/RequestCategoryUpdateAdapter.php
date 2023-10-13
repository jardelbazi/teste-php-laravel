<?php

namespace App\Adapters\Category;

use App\DTO\Category\CategoryUpdateDTO;
use Illuminate\Http\Request;

class RequestCategoryUpdateAdapter extends CategoryUpdateDTO
{
    public function __construct(
        private Request $request,
    ) {
        parent::__construct(
            id: $this->request->route('id'),
            name: $this->request->input('name'),
        );
    }
}
