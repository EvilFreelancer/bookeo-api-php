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
        $this->endpoint = '/settings/apikeyinfo' . '?' . $this->getQuery();

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
        $this->endpoint = '/settings/business' . '?' . $this->getQuery();

        return $this;
    }

    /**
     * Retrieve custom fields about customers and participants
     *
     * @return $this
     */
    public function customercustomfields(): self
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/settings/customercustomfields' . '?' . $this->getQuery();

        return $this;
    }

    /**
     * Retrieve all supported languages
     *
     * @return $this
     */
    public function languages(): self
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/settings/languages' . '?' . $this->getQuery();

        return $this;
    }

    /**
     * Retrieve all supported people categories
     *
     * Retrieve the people categories supported by this account.
     * This can include the default ones ("Adults","Children","Infants") and also custom ones defined by the account ("Students", ...)
     *
     * @return $this
     */
    public function peoplecategories(): self
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/settings/peoplecategories' . '?' . $this->getQuery();

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
        $this->endpoint = '/settings/products' . '?' . $this->getQuery();

        return $this;
    }

    /**
     * Retrieve all available resources
     *
     * @return $this
     */
    public function resources(): self
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/settings/resources' . '?' . $this->getQuery();

        return $this;
    }

    /**
     * Retrieve all taxes used by this business
     *
     * @return $this
     */
    public function taxes(): self
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/settings/taxes' . '?' . $this->getQuery();

        return $this;
    }

}
