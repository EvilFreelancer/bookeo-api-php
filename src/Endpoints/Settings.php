<?php

namespace Bookeo\Endpoints;

use Bookeo\Client;

/**
 * Access account settings
 *
 * @package Bookeo\Endpoints
 */
class Settings extends Client
{
    /**
     * Get information about your own API Key
     *
     * @return $this
     */
    public function apikeyinfo(): self
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = $this->config->get('base_uri') . '/settings/apikeyinfo';

        return $this;
    }

    /**
     * Get information, location and contact details about the business
     *
     * @return $this
     */
    public function business(): self
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = $this->config->get('base_uri') . '/settings/business';

        return $this;
    }

    /**
     * Get information about all the products (things that can be booked) offered.
     * 3 types of product are available:
     * - fixed are products with a fixed schedule and a given number of seats. Ex a group tour, a class, a workshop
     * - fixedCourse are fixed products that are defined as a course, i.e. comprise of a series of dates
     * - flexibleTime are products that describe private appointments, i.e. when one booking uses one resource (teacher, consultant, etc)
     *
     * Although Bookeo applies a minimum amount of caching, it is recommended to cache these results for 10-15 minutes to improve the performance of your application, as product settings change rarely.
     *
     * @return $this
     */
    public function products(): self
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = $this->config->get('base_uri') . '/settings/products';

        return $this;
    }
}
