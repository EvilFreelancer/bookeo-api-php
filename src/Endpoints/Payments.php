<?php

namespace Bookeo\Endpoints;

use Bookeo\Client;
use Bookeo\Interfaces\QueryInterface;
use Bookeo\Models\Payment;
use Bookeo\Models\PaymentsList;

/**
 * Operations to manage payments
 *
 * @package Bookeo\Endpoints
 */
class Payments extends Client
{
    /**
     * Get a list of payments received
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function all(): QueryInterface
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/payments' . '?' . $this->getQuery();
        $this->response = PaymentsList::class;

        return $this;
    }

    /**
     * Retrieve a specific paymen
     *
     * @param string $payment_id
     *
     * @return $this
     */
    public function __invoke(string $payment_id)
    {
        $this->payment_id = $payment_id;

        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/payments/' . $payment_id . '?' . $this->getQuery();
        $this->response = Payment::class;

        return $this;
    }
}
