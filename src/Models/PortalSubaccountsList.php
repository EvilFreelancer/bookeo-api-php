<?php

namespace Bookeo\Models;

use Bookeo\Model;

class PortalSubaccountsList extends Model
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
            'data' => 'array[PortalSubaccount]',
        ];
    }
}
