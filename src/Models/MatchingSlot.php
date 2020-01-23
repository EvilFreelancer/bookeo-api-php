<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class MatchingSlot
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class MatchingSlot extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'startTime'      => 'string:datetime',
            'endTime'        => 'string:datetime',
            'price'          => Money::class,          // Note that this is the "display" price . The account may have set up taxes not included in the price, which are only shown at checkout . This element is included for products of type fixed and fixedCourse . It is not included for products of type flexibleTime . Call HTTP POST / holds to create a hold at checkout and get the final price details, including taxes . [read - only],
            'courseSchedule' => CourseSchedule::class, // If the product is of type fixedCourse, this includes the full schedule of the course . In this case startTime and endTime are the start and end times of the first event in the schedule . If late enrollment is enabled, startTime and endTime will refer to the first event in the course that is booked . If the product is not of type fixedCourse, this field is omitted . [read - only],
            'eventId'        => 'string',              // Unique id that identifies the slot, it can be used to create bookings for this slot [read - only],
            'resources'      => 'Array[Resource]',     // Resources involved in this slot . This field is only included for products of type fixed or fixedCourse . Only resources whose type is "public" are listed here . [read - only]
        ];
    }
}
