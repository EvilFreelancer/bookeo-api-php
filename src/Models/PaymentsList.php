<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class PaymentsList
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class PaymentsList extends Model
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
            'data' => 'array[Payment]',
        ];
    }
}
