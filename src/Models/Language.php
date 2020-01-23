<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class PeopleCategory
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class Language extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'tag'              => 'string',  // [read-only],
            'name'             => 'string',  // [read-only],
            'customersDefault' => 'boolean', // [read-only]
        ];
    }
}