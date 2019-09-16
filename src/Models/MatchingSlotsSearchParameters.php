<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class MatchingSlotsSearchParameters
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class MatchingSlotsSearchParameters extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'productId'     => 'string', // the unique product id. To get a list of products and their ids, see /settings/products,
            'startTime'     => 'string:datetime',
            'endTime'       => 'string:datetime',
            'peopleNumbers' => 'array[PeopleNumber]',
            'options'       => 'array[BookingOption]',
            'resources'     => 'array[Resource]',
        ];
    }


}
