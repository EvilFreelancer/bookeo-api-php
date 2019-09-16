<?php

namespace Bookeo\Endpoints;

use Bookeo\Client;
use Bookeo\Models\Webhook;
use Bookeo\Models\WebhooksList;

/**
 * Manage callback notifications
 *
 * @package Bookeo\Endpoints
 */
class Webhooks extends Client
{
    /**
     * List all webhooks
     *
     * Retrieve all the webhooks for this api key
     *
     * @return $this
     */
    public function all(): self
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/webhooks' . '?' . $this->getQuery();
        $this->response = WebhooksList::class;

        return $this;
    }

    /**
     * Create a new webhook
     *
     * Note that if an existing webhook for the same domain and type was already set for this api key, it will be automatically replaced by this new webhook.
     * In other words, there can be only one webhook for each combination of domain and type, for an API key.
     * So to upgrade an existing webhook URL, simply create a new one with the same domain and type, but a different URL.
     *
     * For webhook with domain "bookings" and type "deleted", the notification will be sent whether the booking is canceled or completely deleted.
     * Users can delete bookings by, for example, deleting their associated customer.
     * Also note that these "bookings" "deleted" notifications are sent even for bookings in the past.
     *
     * @param Webhook $webhook
     *
     * @return $this
     */
    public function create(Webhook $webhook): self
    {
        // Set HTTP params
        $this->type     = 'post';
        $this->endpoint = '/webhooks' . '?' . $this->getQuery();
        $this->params   = $webhook;
        $this->response = Webhook::class;

        return $this;
    }

    /**
     * Retrieve a webhook
     *
     * @param string $webhook_id
     *
     * @return $this
     */
    public function __invoke(string $webhook_id)
    {
        $this->webhook_id = $webhook_id;

        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/webhooks/' . $webhook_id . '?' . $this->getQuery();
        $this->response = Webhook::class;

        return $this;
    }

    /**
     * Delete a webhook
     *
     * @return $this
     */
    public function delete(): self
    {
        // Set HTTP params
        $this->type     = 'delete';
        $this->endpoint = '/webhooks/' . $this->webhook_id;

        return $this;
    }
}
