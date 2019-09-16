<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class MatchingSlotList
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class MatchingSlotList extends Model
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
            'data' => 'array[MatchingSlot]',
        ];
    }
}
