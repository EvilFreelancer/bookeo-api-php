<?php

namespace Bookeo\Models;

use Bookeo\Model;

class Customer extends Model
{
    /**
     * List of allowed fields
     *
     * @codeCoverageIgnore
     * @return array
     */
    public function allowed(): array
    {
        return [
            'id'                         => 'string', // Globally unique ID that identifies this person
            'firstName'                  => 'string',
            'middleName'                 => 'string',
            'lastName'                   => 'string',
            'emailAddress'               => 'string',
            'phoneNumbers'               => 'array[PhoneNumber]',
            'streetAddress'              => 'StreetAddress',
            'creationTime'               => 'string:datetime',
            'startTimeOfNextBooking'     => 'string:datetime', // The start time of the next booking. null if there are no bookings starting after 'now'. [read-only],
            'startTimeOfPreviousBooking' => 'string:datetime', // The start time of the last booking that occurred before 'now'. It is updated only after that booking's stop time [read-only],
            'dateOfBirth'                => 'string:date',
            'customFields'               => 'array[CustomField]',
            'gender'                     => 'string', // The gender of this person. = ['male' or 'female' or 'unknown'],
            'facebookId'                 => 'string',
            'credit'                     => 'Money',
            'languageCode'               => 'string', // The language code that is preferred by the customer. It is set only if the customer has selected a specific language when creating or reviewing the booking, otherwise it is not set and the default language is assumed. The format is a modified version of the Internet standard rfc5646, replacing the - character (dash) with a _ character (underscore). Example: en_US,
            'acceptSmsReminders'         => 'boolean',
            'numBookings'                => 'integer', // Number of bookings that this customer has made
            'numCancelations'            => 'integer', // Number of booking cancellations that were tracked for this customer
            'numNoShows'                 => 'integer', // Number of no-shows for this customer
            'member'                     => 'boolean', // Whether this customer is currently a member
            'membershipEnd'              => 'date', // When the membership expires. If the membership is not set to expire, this field is not set.
        ];
    }
}
