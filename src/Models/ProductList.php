<?php

namespace Bookeo\Models;

class ProductList
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
