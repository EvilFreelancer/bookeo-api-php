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

    /*
LinkedPerson {
id (string): Globally unique ID that identifies this person [read-only],
firstName (string, optional),
middleName (string, optional),
lastName (string, optional),
emailAddress (string, optional),
phoneNumbers (Array[PhoneNumber], optional),
streetAddress (StreetAddress, optional),
creationTime (date-time): [read-only],
startTimeOfNextBooking (date-time, optional): The start time of the next booking. null if there are no bookings starting after 'now'. [read-only],
startTimeOfPreviousBooking (date-time, optional): The start time of the last booking that occurred before 'now'. It is updated only after that booking's stop time [read-only],
dateOfBirth (date, optional),
customFields (Array[CustomField], optional),
gender (string, optional): The gender of this person. = ['male' or 'female' or 'unknown'],
customerId (string): The id of the customer to whom this person is linked. [read-only]
}
     */

}
