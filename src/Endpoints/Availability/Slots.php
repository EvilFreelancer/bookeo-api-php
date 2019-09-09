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
    public function __invoke(string $productId, string $startTime, string $endTime, string $pageNavigationToken, int $itemsPerPage = 50, int $pageNumber = 1)
    {
        $query = http_build_query(['pageNumber' => $pageNumber]);

        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = $this->config->get('base_uri') . '/availability/slots';
        $this->response = SlotList::class;

        return $this;
    }
}
