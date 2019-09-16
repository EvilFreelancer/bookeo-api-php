<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class PaginationInfo
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class PaginationInfo extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'totalItems'          => 'integer',
            'totalPages'          => 'integer',
            'currentPage'         => 'integer',
            'pageNavigationToken' => 'string' // If there are more than 1 pages of items available, you can use this token in more calls (combined with pageNumber) to navigate the results. When navigating pages, you do not need to include the search parameters again - just pageNavigationToken and pageNumber. If there is only one page, this field is not present in the response. [read-only]
        ];
    }
}
