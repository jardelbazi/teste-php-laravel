<?php

namespace App\Adapters\Document;

use App\DTO\Document\DocumentFilterDTO;
use Illuminate\Http\Request;

class RequestDocumentFilterAdapter extends DocumentFilterDTO
{
    public function __construct(
        private Request $request,
    ) {
        parent::__construct(
            id: $this->request->route('id'),
        );
    }
}
