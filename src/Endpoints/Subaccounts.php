<?php

namespace Bookeo\Endpoints;

use Bookeo\Client;
use Bookeo\Models\PortalSubaccountsList;

/**
 * Access subaccounts part of a Bookeo Portal
 *
 * @package Bookeo\Endpoints
 */
class Subaccounts extends Client
{
    /**
     * @var string
     */
    protected $namespace = __CLASS__;

    /**
     * Create a new API Key for this application to access a subaccount
     *
     * Install this application in a subaccount.
     * Note that the API key used in this call must be that of the portal manager account. The application installed in the subaccount will be the same as this one, with the same permissions.
     * If this application was already installed in the subaccount, its API key will be replaced by the one created in this call.
     *
     * @param string $subaccountId
     *
     * @return $this
     */
    public function create(string $subaccountId): self
    {
        // Set HTTP params
        $this->type     = 'post';
        $this->endpoint = '/subaccounts/' . $subaccountId . '?' . $this->getQuery();

        return $this;
    }

    /**
     * Delete the API Key for this application from a subaccount
     *
     * Uninstall this application from a subaccount.
     *
     * @param string $subaccountId
     * @param string $apiKey
     *
     * @return $this
     */
    public function delete(string $subaccountId, string $apiKey): self
    {
        // Set HTTP params
        $this->type     = 'delete';
        $this->endpoint = '/subaccounts/' . $subaccountId . '/apikeys/' . $apiKey . '?' . $this->getQuery();

        return $this;
    }

    /**
     * List all subaccounts in the portal
     *
     * Retrieve all the webhooks for this api key
     *
     * @param int         $itemsPerPage
     * @param string|null $pageNavigationToken
     * @param int         $pageNumber
     *
     * @return $this
     */
    public function all(int $itemsPerPage = 100, string $pageNavigationToken = null, int $pageNumber = 1): self
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
        $this->endpoint = '/subaccounts' . '?' . $this->getQuery();
        $this->response = PortalSubaccountsList::class;

        return $this;
    }
}
