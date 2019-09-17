<?php

namespace Bookeo\Models;

use Bookeo\Model;

class PortalSubaccount extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'id'   => 'string', // The unique id for this subaccount
            'name' => 'string', // The unique account name
        ];
    }
}
