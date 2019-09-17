<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class ProductList
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class ProductList extends Model
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
            'data' => 'array[Product]',
        ];
    }
}
