<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class PortalSubaccountsList
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
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
            'info' => PaginationInfo::class,
            'data' => 'array[PortalSubaccount]',
        ];
    }
}
