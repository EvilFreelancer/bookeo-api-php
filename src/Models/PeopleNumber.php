<?php

namespace Bookeo\Models;

use Bookeo\Model;

class PeopleNumber extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'peopleCategoryId' => 'string', // The id of the PeopleCategory to which these participants belong to. See /settings/peoplecategories,
            'number'           => 'int',    // Indicates how many people of this category are in the booking
        ];
    }
}
