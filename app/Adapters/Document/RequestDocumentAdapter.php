<?php

namespace App\Adapters\Document;

use App\DTO\Document\DocumentDTO;
use Illuminate\Http\Request;

class RequestDocumentAdapter extends DocumentDTO
{
    public function __construct(
        private Request $request
    ) {
        parent::__construct(
            category_id: $this->request->input('category_id'),
            title: $this->request->input('title'),
            contents: $this->request->input('contents'),
        );
    }
}
