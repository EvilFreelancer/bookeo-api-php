<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class Webhook
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class Webhook extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'id'            => 'string', // The id of the resource.
            'url'           => 'string', // The URL that Bookeo will request when an event triggers the webhook. The protocol must be https,
            'domain'        => 'string', // What type of object this webhook applies to = ['bookings' or 'seatblocks' or 'resourceblocks' or 'customers' or 'payments'],
            'type'          => 'string', // What type of operation triggers this webhook = ['created' or 'updated' or 'deleted'],
            'blockedTime'   => 'string:datetime', // If this field is present, it indicates that the webhook was blocked at this time. The blockedReason will indicate the reason for the block. Typically, a webhook gets blocked when too many consecutive notifications are dropped due to repeat conection errors. Once a webhook is blocked, no more notifications will be sent to it. Your application will need to fix the cause of the block, and then create a new webhook. [read-only],
            'blockedReason' => 'string', // The reason why the webhook was blocked. [read-only]
        ];
    }
}
