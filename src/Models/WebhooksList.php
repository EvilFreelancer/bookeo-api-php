<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class WebhooksList
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class WebhooksList extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'info' => 'PaginationInfo',
            'data' => 'array[Webhook]',
        ];
    }
}
