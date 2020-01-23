<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class HoldCreate
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class HoldCreate extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'productId'    => 'string',
            'eventId'      => 'string',
            'customer'     => Customer::class,
            'participants' => 'array'
        ];
    }

    /**
     * List of required fields
     *
     * @return array
     */
    public function required(): array
    {
        return [
            'productId',
            'eventId',
            'customer',
            'participants',
        ];
    }
}
