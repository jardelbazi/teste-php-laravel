<?php

namespace App\Interpreters\Document;

use App\DTO\Document\DocumentFilterDTO;
use App\Helpers\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class DocumentIdAttributeInterpreter extends DbInterpreter
{
    public function __construct(
        private DocumentFilterDTO $filter,
    ) {
    }

    /**
     * @return Builder
     */
    public function interpret(): Builder
    {
        $id = $this->filter->id;

        if (blank($id))
            return $this->query;

        return $this->query->where('id', $id);
    }
}
