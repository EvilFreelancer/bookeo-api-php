<?php

namespace Bookeo\Endpoints\Availability;

use Bookeo\Endpoints\Availability;
use Bookeo\Models\MatchingSlotList;
use Bookeo\Models\MatchingSlotsSearchParameters;

/**
 * Class MatchingSlots
 *
 * @package Bookeo\Endpoints\Availability
 */
class MatchingSlots extends Availability
{
    /**
     * Create a search for available slots that match the given search parameters.
     * Note that there are two different searches possible, /availability/slots and /availability/matchingslots (this endpoint).
     * The former simply shows the number of available seats for each available slot. The latter (this one) takes as input the participant numbers, and shows the slots that are available for those numbers, and an estimate of the price.
     * Parameters include product code, number of people and options.
     * The successful response also contains a "Location" HTTP header, which can be invoked to navigate the results of the search.
     *
     * @param MatchingSlotsSearchParameters $search
     *
     * @return $this
     */
    public function create(MatchingSlotsSearchParameters $search): self
    {
        // Set HTTP params
        $this->type     = 'post';
        $this->endpoint = $this->config->get('base_uri') . '/availability/matchingslots';
        $this->params   = $search;
        $this->response = MatchingSlotList::class;

        return $this;
    }

    /**
     * Navigate results of a matching slots search
     *
     * @param string $pageNavigationToken
     * @param int    $pageNumber
     *
     * @return $this
     */
    public function __invoke(string $pageNavigationToken, int $pageNumber = 1)
    {
        $query = http_build_query(['pageNumber' => $pageNumber]);

        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = $this->config->get('base_uri') . '/availability/matchingslots/' . $pageNavigationToken . '?' . $query;
        $this->response = MatchingSlotList::class;

        return $this;
    }
}
