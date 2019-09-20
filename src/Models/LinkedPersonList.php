<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class LinkedPersonList
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class LinkedPersonList extends Model
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
            'data' => 'array[LinkedPerson]',
        ];
    }
}
