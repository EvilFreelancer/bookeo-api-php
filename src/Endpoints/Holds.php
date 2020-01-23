<?php

namespace Bookeo\Endpoints;

use Bookeo\Client;
use Bookeo\Interfaces\QueryInterface;
use Bookeo\Models\Hold;
use Bookeo\Models\HoldCreate;

/**
 * Access account settings
 *
 * @package Bookeo\Endpoints
 */
class Holds extends Client
{
    /**
     * Retrieve a hold previously generated
     *
     * @param string $hold_id
     *
     * @return $this
     */
    public function __invoke(string $hold_id)
    {
        $this->hold_id = $hold_id;

        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/holds/' . $hold_id . '?' . $this->getQuery();
        $this->response = Hold::class;

        return $this;
    }

    /**
     * Create a temporary hold to finalize the booking
     *
     * Performs a final check of the booking, and reserves required resources/seats to allow finalization of the booking process (ex. process payment).
     * The returned object also contains the updated price calculations.
     * Normally your application should have no more than one hold in place during a customer booking process.
     * Make sure to not leave many holds around. In any case, holds are deleted automatically after a fixed time from creation.
     * Note that when creating a hold, the customer field of the booking can be missing, in which case Bookeo will assume a default customer coming from the same country as the account.
     * The successful response also contains a "Location" HTTP header, which can be used to access the created resource in future invocations.
     *
     * @param \Bookeo\Models\HoldCreate $create
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function create(HoldCreate $create): QueryInterface
    {
        // Set HTTP params
        $this->type     = 'post';
        $this->endpoint = '/holds?' . $this->getQuery();
        $this->response = Hold::class;

        return $this;
    }

    /**
     * Delete a temporary hold
     *
     * Delete a temporary hold previously created.
     * Note that you can also delete a hold when creating a new hold (ex. when the customer goes back in the booking process and selects a different time), or when creating a booking (i.e. when the customer checks out), without having to make a separate call to this endpoint.
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function delete(): QueryInterface
    {
        // Set HTTP params
        $this->type     = 'delete';
        $this->endpoint = '/holds/' . $this->hold_id . '?' . $this->getQuery();

        return $this;
    }
}
