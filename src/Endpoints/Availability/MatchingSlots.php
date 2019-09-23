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
     * The former simply shows the number of available seats for each available slot. The latter (this one) takes as input the participant numbers, and shows the slots that are
     * available for those numbers, and an estimate of the price. Parameters include product code, number of people and options. The successful response also contains a "Location"
     * HTTP header, which can be invoked to navigate the results of the search.
     *
     * @param \Bookeo\Models\MatchingSlotsSearchParameters $search
     * @param int                                          $itemsPerPage maximum: 300
     *
     * @return $this
     */
    public function search(MatchingSlotsSearchParameters $search, int $itemsPerPage = 50): self
    {
        if (!empty($itemsPerPage)) {
            $this->appendToQuery('itemsPerPage', $itemsPerPage);
        }

        // Set HTTP params
        $this->type     = 'post';
        $this->endpoint = '/availability/matchingslots' . '?' . $this->getQuery();
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
        if (!empty($pageNumber)) {
            $this->appendToQuery('pageNumber', $pageNumber);
        }

        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/availability/matchingslots/' . $pageNavigationToken . '?' . $this->getQuery();
        $this->response = MatchingSlotList::class;

        return $this;
    }
}
