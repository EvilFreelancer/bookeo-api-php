<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class BookingOption
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class BookingOption extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'id'    => 'string', // The id of the option. It must match the id of an existing ChoiceOption, NumberOption, OnOffOption or TextOption for the product. See /settings/products to retrieve the list of options for each product When submitting a booking, either the id or the name field are required. If both are supplied, Bookeo will only consider the id field.,
            'name'  => 'string', // The name of the option It must match the name of an existing ChoiceOption, NumberOption, OnOffOption or TextOption for the product. See /settings/products to retrieve the list of options for each product. When submitting a booking, either the id or the name field are required. If both are supplied, Bookeo will only consider the id field,
            'value' => 'string', // The value of the option. For checkbox-type options, possible values are "true" and "false". For choice options, this is the name (i.e. plain text) of the chosen value, not the id
        ];
    }
}
