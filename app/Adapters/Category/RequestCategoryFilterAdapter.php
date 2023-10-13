<?php

namespace App\Adapters\Category;

use App\DTO\Category\CategoryFilterDTO;
use Illuminate\Http\Request;

class RequestCategoryFilterAdapter extends CategoryFilterDTO
{
    public function __construct(
        private Request $request,
    ) {
        parent::__construct(
            id: $this->request->route('id'),
        );
    }
}
