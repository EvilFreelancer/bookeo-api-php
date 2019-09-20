<?php

namespace Bookeo\Endpoints;

use Bookeo\Client;
use Bookeo\Models\Customer;
use Bookeo\Models\CustomersList;

/**
 * Operations to manage customers
 *
 * @package Bookeo\Endpoints
 */
class Customers extends Client
{

    /**
     * Retrieve customers
     *
     * Get a list of customers.
     *
     * @return $this
     */
    public function all(): self
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/customers' . '?' . $this->getQuery();
        $this->response = CustomersList::class;

        return $this;
    }

    /**
     * Create a new customer.
     *
     * Please note there is a limit to the number of customers that can be imported in Bookeo. Bookeo is primarily a booking system, not a CRM.
     *
     * @param Customer $customer
     * @return Customers
     */
    public function create(Customer $customer): self
    {
        // Set HTTP params
        $this->type     = 'post';
        $this->endpoint = '/customers' . '?' . $this->getQuery();
        $this->params   = $customer;
        $this->response = Customer::class;

        return $this;
    }
}
