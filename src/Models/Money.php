<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class Money
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class Money extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'amount'   => 'float',
            'currency' => 'string', // Currency code in ISO 4217 format
        ];
    }
}
