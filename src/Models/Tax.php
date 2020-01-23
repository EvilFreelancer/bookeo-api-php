<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class TaxesList
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class Tax extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'id'   => 'string',  // [read-only],
            'name' => 'string',  // [read-only],
        ];
    }
}
