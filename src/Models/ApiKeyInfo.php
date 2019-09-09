<?php

namespace Bookeo\Models;

use Bookeo\Model;

class ApiKeyInfo extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'accountId'    => 'string', // The unique identifier of the business (Bookeo account) that has installed this key. If the application is uninstalled, and then installed again for the same business, the api key would change, but the accountId would not. [read-only],
            'permissions'  => 'string',
            'creationTime' => 'string:datetime',
        ];
    }
}
