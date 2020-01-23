<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class CustomersList
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class CustomersList extends Model
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
            'data' => 'array[Customer]',
        ];
    }
}
