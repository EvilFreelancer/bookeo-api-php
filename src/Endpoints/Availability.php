<?php

namespace Bookeo\Endpoints;

use Bookeo\Client;
use Bookeo\Endpoints\Availability\MatchingSlots;
use Bookeo\Endpoints\Availability\Slots;

/**
 * @method Slots         slots(string $productId = null, string $startTime = null, string $endTime = null, int $itemsPerPage = 50, string $pageNavigationToken = null, int $pageNumber = 1)
 * @method MatchingSlots matching_slots(string $pageNavigationToken, int $pageNumber = 1)
 *
 * @property MatchingSlots $matching_slots
 *
 * Operations to query about product availability
 *
 * @package Bookeo\Endpoints
 */
class Availability extends Client
{
    /**
     * @var string
     */
    protected $namespace = __CLASS__;
}
