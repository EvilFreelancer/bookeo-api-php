<?php

namespace Bookeo\Endpoints\Availability;

use Bookeo\Endpoints\Availability;
use Bookeo\Models\SlotList;

class Slots extends Availability
{
    /**
     * Navigate results of a matching slots search
     *
     * @param string $productId    the product id (see /settings/products). If not provided, all products of type "fixed" or "fixedCourse" will be included in the result. If no productId is provided, products that are not bookable by customers wil not be included in the result. If productId is provided, the product must be of type "fixed" or "fixedCourse". For products of type "flexibleTime", use /availability/matchingslots instead.
     * @param string $startTime    the start time to search from. Required unless pageNavigationToken is used.
     * @param string $endTime      the end time to search to. Required unless pageNavigationToken is used. The maximum date range in a single call is 31 days.
     * @param string $pageNavigationToken
     * @param int    $itemsPerPage maximum: 300
     * @param int    $pageNumber
     *
     * @return $this
     */
    public function __invoke(string $productId = null, string $startTime = null, string $endTime = null, int $itemsPerPage = 50, string $pageNavigationToken = null, int $pageNumber = 1)
    {
        if (null !== $productId) {
            $this->appendToQuery('productId', $productId);
        }

        if (null !== $startTime && null === $pageNavigationToken) {
            $this->appendToQuery('startTime', $startTime);
        } elseif (null === $startTime && null !== $pageNavigationToken) {
            $this->appendToQuery('pageNavigationToken', $pageNavigationToken);
        } else {
            throw new \InvalidArgumentException('At least "startTime" or "pageNavigationToken" must be set');
        }

        if (null !== $endTime) {
            $this->appendToQuery('endTime', $endTime);
        }

        if (null !== $itemsPerPage) {
            $this->appendToQuery('itemsPerPage', $itemsPerPage);
        }

        if (null !== $pageNumber) {
            $this->appendToQuery('pageNumber', $pageNumber);
        }

        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/availability/slots' . '?' . $this->getQuery();
        $this->response = SlotList::class;

        return $this;
    }
}
