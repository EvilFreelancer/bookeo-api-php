<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class LinkedPerson
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class LinkedPerson extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'id'                         => 'string', // Globally unique ID that identifies this person [read-only],
            'firstName'                  => 'string',
            'middleName'                 => 'string',
            'lastName'                   => 'string',
            'emailAddress'               => 'string',
            'phoneNumbers'               => 'Array[PhoneNumber]',
            'streetAddress'              => StreetAddress::class,
            'creationTime'               => 'string:datetime', // [read-only],
            'startTimeOfNextBooking'     => 'string:datetime', // The start time of the next booking. null if there are no bookings starting after 'now'. [read-only],
            'startTimeOfPreviousBooking' => 'string:datetime', // The start time of the last booking that occurred before 'now'. It is updated only after that booking's stop time [read-only],
            'dateOfBirth'                => 'string:date',
            'customFields'               => 'Array[CustomField]',
            'gender'                     => 'string', // The gender of this person. = ['male' or 'female' or 'unknown'],
            'customerId'                 => 'string', // The id of the customer to whom this person is linked. [read-only]
        ];
    }
}
