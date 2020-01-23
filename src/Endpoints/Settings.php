<?php

namespace Bookeo\Endpoints;

use Bookeo\Client;
use Bookeo\Interfaces\QueryInterface;
use Bookeo\Models\ApiKeyInfo;
use Bookeo\Models\Business;
use Bookeo\Models\CustomFieldDefinitions;
use Bookeo\Models\LanguagesList;
use Bookeo\Models\PeopleCategoryList;
use Bookeo\Models\ProductList;
use Bookeo\Models\ResourceTypesList;
use Bookeo\Models\TaxesList;

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
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function apikeyinfo(): QueryInterface
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/settings/apikeyinfo' . '?' . $this->getQuery();
        $this->response = ApiKeyInfo::class;

        return $this;
    }

    /**
     * Get information, location and contact details about the business
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function business(): QueryInterface
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/settings/business' . '?' . $this->getQuery();
        $this->response = Business::class;

        return $this;
    }

    /**
     * Retrieve custom fields about customers and participants
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function customercustomfields(): QueryInterface
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/settings/customercustomfields' . '?' . $this->getQuery();
        $this->response = CustomFieldDefinitions::class;

        return $this;
    }

    /**
     * Retrieve all supported languages
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function languages(): QueryInterface
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/settings/languages' . '?' . $this->getQuery();
        $this->response = LanguagesList::class;

        return $this;
    }

    /**
     * Retrieve all supported people categories
     *
     * Retrieve the people categories supported by this account.
     * This can include the default ones ("Adults","Children","Infants") and also custom ones defined by the account ("Students", ...)
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function peoplecategories(): QueryInterface
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/settings/peoplecategories' . '?' . $this->getQuery();
        $this->response = PeopleCategoryList::class;

        return $this;
    }

    /**
     * Get information about all the products (things that can be booked) offered.
     * 3 types of product are available:
     * - fixed are products with a fixed schedule and a given number of seats. Ex a group tour, a class, a workshop
     * - fixedCourse are fixed products that are defined as a course, i.e. comprise of a series of dates
     * - flexibleTime are products that describe private appointments, i.e. when one booking uses one resource (teacher, consultant, etc)
     *
     * Although Bookeo applies a minimum amount of caching, it is recommended to cache these results for 10-15 minutes to improve the performance of your application, as product
     * settings change rarely.
     *
     * @param string|null $type
     * @param int         $itemsPerPage
     * @param string|null $pageNavigationToken
     * @param int         $pageNumber
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function products(string $type = null, int $itemsPerPage = 50, string $pageNavigationToken = null, int $pageNumber = 1): QueryInterface
    {
        if (!empty($type)) {
            $this->appendToQuery('type', $type);
        }

        if (!empty($itemsPerPage)) {
            $this->appendToQuery('itemsPerPage', $itemsPerPage);
        }

        if (!empty($pageNavigationToken)) {
            $this->appendToQuery('pageNavigationToken', $pageNavigationToken);
        }

        if (!empty($pageNumber)) {
            $this->appendToQuery('pageNumber', $pageNumber);
        }

        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/settings/products' . '?' . $this->getQuery();
        $this->response = ProductList::class;

        return $this;
    }

    /**
     * Retrieve all available resources
     *
     * @param int         $itemsPerPage
     * @param string|null $pageNavigationToken
     * @param int         $pageNumber
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function resources(int $itemsPerPage = 50, string $pageNavigationToken = null, int $pageNumber = 1): QueryInterface
    {
        if (!empty($itemsPerPage)) {
            $this->appendToQuery('itemsPerPage', $itemsPerPage);
        }

        if (!empty($pageNavigationToken)) {
            $this->appendToQuery('pageNavigationToken', $pageNavigationToken);
        }

        if (!empty($pageNumber)) {
            $this->appendToQuery('pageNumber', $pageNumber);
        }

        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/settings/resources' . '?' . $this->getQuery();
        $this->response = ResourceTypesList::class;

        return $this;
    }

    /**
     * Retrieve all taxes used by this business
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function taxes(): QueryInterface
    {
        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/settings/taxes' . '?' . $this->getQuery();
        $this->response = TaxesList::class;

        return $this;
    }

}
