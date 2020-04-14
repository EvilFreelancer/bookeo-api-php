<?php

namespace Bookeo\Endpoints;

use Bookeo\Client;
use Bookeo\Interfaces\QueryInterface;
use Bookeo\Models\BookingsList;
use Bookeo\Models\Customer;
use Bookeo\Models\CustomersList;
use Bookeo\Models\LinkedPersonList;

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
     * @param string|null $searchText
     * @param string|null $searchField
     * @param string|null $createdSince date-time
     * @param bool|null   $currentMembers
     * @param bool|null   $currentNonMembers
     * @param int         $itemsPerPage maximum: 100
     * @param string|null $pageNavigationToken
     * @param int         $pageNumber
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function all(
        string $searchText = null,
        string $searchField = null,
        string $createdSince = null,
        bool $currentMembers = true,
        bool $currentNonMembers = true,
        int $itemsPerPage = 50,
        string $pageNavigationToken = null,
        int $pageNumber = 1
    ): QueryInterface {

        if (!empty($searchText)) {
            $this->appendToQuery('searchText', $searchText);
        }

        if (!empty($searchField)) {
            $this->appendToQuery('searchField', $searchField);
        }

        if (!empty($createdSince)) {
            $this->appendToQuery('createdSince', $createdSince);
        }

        if ($currentMembers !== null) {
            $this->appendToQuery('currentMembers', $currentMembers);
        }

        if ($currentNonMembers !== null) {
            $this->appendToQuery('currentNonMembers', $currentNonMembers);
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
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function create(Customer $customer): QueryInterface
    {
        // Set HTTP params
        $this->type     = 'post';
        $this->endpoint = '/customers' . '?' . $this->getQuery();
        $this->params   = $customer;
        $this->response = Customer::class;

        return $this;
    }

    /**
     * Retrieve a customer
     *
     * Retrieve a customer by its id
     *
     * @param string $customer_id
     *
     * @return $this
     */
    public function __invoke(string $customer_id)
    {
        $this->customer_id = $customer_id;

        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/customers/' . $customer_id . '?' . $this->getQuery();
        $this->response = Customer::class;

        return $this;
    }

    /**
     * Update an existing customer
     *
     * @param Customer $customer
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function update(Customer $customer): QueryInterface
    {
        // Set HTTP params
        $this->type     = 'put';
        $this->endpoint = '/customers/' . $this->customer_id . '?' . $this->getQuery();
        $this->params   = $customer;

        return $this;
    }

    /**
     * Delete a customer
     *
     * Please note it is not possible to delete customers that have bookings in the future, and that are not cancelled.
     * If your application needs to delete a customer with future bookings, make sure to cancel all future bookings for that customer first.
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function delete(): QueryInterface
    {
        // Set HTTP params
        $this->type     = 'delete';
        $this->endpoint = '/customers/' . $this->customer_id . '?' . $this->getQuery();

        return $this;
    }

    /**
     * The customer's email address is the "username" used by Bookeo to authenticate customers.
     * So to authenticate a customer your application would typically use GET /customers to search for customers with a given email address, and then GET
     * /customers/{id}/authenticate to authenticate. Remember that there may be duplicate customer records with the same email address, ex. due to duplicate importing or manual
     * record creation.
     *
     * @param string $password
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function authenticate(string $password): QueryInterface
    {
        $this->appendToQuery('password', $password);

        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/customers/' . $this->customer_id . '/authenticate?' . $this->getQuery();

        return $this;
    }

    /**
     * @param string|null $beginDate          if specified, only bookings on or after this date will be included
     * @param string|null $endDate            if specified, only bookings on or before this date will be included
     * @param bool        $expandParticipants if true, full details of the participants are included (provided the application has read permission over the participant)
     * @param int         $itemsPerPage       maximum: 100
     * @param string|null $pageNavigationToken
     * @param int         $pageNumber
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function bookings(
        string $beginDate = null,
        string $endDate = null,
        bool $expandParticipants = false,
        int $itemsPerPage = 50,
        string $pageNavigationToken = null,
        int $pageNumber = 1
    ): QueryInterface {

        if (!empty($beginDate)) {
            $this->appendToQuery('beginDate', $beginDate);
        }

        if (!empty($endDate)) {
            $this->appendToQuery('endDate', $endDate);
        }

        if (!empty($expandParticipants)) {
            $this->appendToQuery('expandParticipants', $expandParticipants);
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
        $this->endpoint = '/customers/' . $this->customer_id . '/bookings?' . $this->getQuery();
        $this->response = BookingsList::class;

        return $this;
    }

    /**
     * Get the people linked to a customer
     *
     * @param int         $itemsPerPage maximum: 100
     * @param string|null $pageNavigationToken
     * @param int         $pageNumber
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function linkedpeople(
        int $itemsPerPage = 50,
        string $pageNavigationToken = null,
        int $pageNumber = 1
    ): QueryInterface {

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
        $this->endpoint = '/customers/' . $this->customer_id . '/linkedpeople?' . $this->getQuery();
        $this->response = LinkedPersonList::class;

        return $this;
    }
}
