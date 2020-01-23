<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class TaxesList
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class TaxesList extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'data' => 'Array[Tax]', // [read-only]
        ];
    }
}
