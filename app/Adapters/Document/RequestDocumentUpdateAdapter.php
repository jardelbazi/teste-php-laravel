<?php

namespace App\Adapters\Document;

use App\DTO\Document\DocumentUpdateDTO;
use Illuminate\Http\Request;

class RequestDocumentUpdateAdapter extends DocumentUpdateDTO
{
    public function __construct(
        private Request $request,
    ) {
        parent::__construct(
            id: $this->request->route('id'),
            category_id: $this->request->input('category_id'),
            title: $this->request->input('title'),
            contents: $this->request->input('contents'),
        );
    }
}
