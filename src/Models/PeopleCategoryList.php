<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class PeopleCategoryList
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class PeopleCategoryList extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'categories' => 'Array[PeopleCategory]', // [read-only]
        ];
    }
}
