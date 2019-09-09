<?php

namespace Bookeo\Models;

use Bookeo\Model;

class SlotList extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'info' => 'PaginationInfo',
            'data' => 'array[Slot]',
        ];
    }
}
