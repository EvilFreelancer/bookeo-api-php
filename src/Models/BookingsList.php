<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class BookingsList
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class BookingsList extends Model
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
            'data' => 'array[Booking]',
        ];
    }
}
