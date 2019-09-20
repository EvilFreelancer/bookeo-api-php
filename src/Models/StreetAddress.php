<?php

namespace Bookeo\Models;

use Bookeo\Model;

class StreetAddress extends Model
{
    /**
     * List of allowed fields
     *
     * @codeCoverageIgnore
     * @return array
     */
    public function allowed(): array
    {
        return [
            'address1'    => 'string',
            'address2'    => 'string',
            'city'        => 'string',
            'countryCode' => 'string', // Country code in ISO 3166-1 format,
            'state'       => 'string',
            'postcode'    => 'string',
        ];
    }
}
