<?php

namespace Bookeo\Models;

use Bookeo\Model;

class PhoneNumber extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'number' => 'string',
            'type'   => 'string', // ['mobile' or 'work' or 'home' or 'fax']
        ];
    }
}
