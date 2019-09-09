<?php

namespace Bookeo\Models;

use Bookeo\Model;

class Resource extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'id'   => 'string', // The id of the resource.
            'name' => 'string', // The name of the resource
        ];
    }
}
