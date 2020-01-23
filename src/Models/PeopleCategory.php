<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class PeopleCategory
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class PeopleCategory extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'name'     => 'string',  // [read-only],
            'id'       => 'string',  // [read-only],
            'numSeats' => 'integer', // How many seats a unit of this category actually takes. Ex a category "Family" may take up 4 seats. [read-only]
        ];
    }
}