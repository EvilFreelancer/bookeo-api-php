<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class Booking
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class Booking extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'bookingNumber'               => 'string',             // The unique booking number. Always treat as string [read-only],
            'eventId'                     => 'string',             // When the booking is for a product of type fixed or fixedCourse, this is the id of the slot (see /availability/slots). Note that for fixedCourse, Bookeo always returns the eventId of the first class in a course, even if the customer is enrolled starting from a later class. In this case, firstCourseEnrolledEvent will be set.,
            'firstCourseEnrolledEventId'  => 'string',             // If the product is of type fixedCourse, and it is possible to accept late enrolment, this is the id of the event (class) where the actual enrolment starts.,
            'dropinCourseEnrolledEventId' => 'string',             // If the product is of type fixedCourse, and it is possible to accept bookings for a single class in the course (drop-in), this is the id of the event (class) actually enrolled in.,
            'startTime'                   => 'string:datetime',    // The start time of the booking. When creating a booking, either this or eventId must be specified,
            'endTime'                     => 'string:datetime',    // The end time of the booking. When creating a new booking of type flexibleTime, you can specify this field to force an end time. Or you can omit this field, in which case Bookeo will calculate the end time based on product and options chosen.,
            'customerId'                  => 'string',             // The id of the customer this booking is for. When creating a booking, use this to create a booking for an existing customer.,
            'customer'                    => 'Customer',           // The customer associated with this booking When reading a booking, this field is included only if the parameter expandCustomer is set to true, and the application has the necessary read permission for the customer. An application can include this field only when creating a new booking for a new customer. To create a booking for an existing customer, use the customerId field instead,
            'title'                       => 'string',             // The title of this booking, same as the one displayed by Bookeo in the calendar [read-only],
            'externalRef'                 => 'string',             // An external reference number that identifies this booking in an external system. The maximum length is 64 characters.,
            'participants'                => 'Array[Participant]', // Participants associated to this booking,
            'resources'                   => 'Array[Resource]',    // Resources involved in a booking, if the booking is for a product of type "flexibleTime". If the booking is for a different type of product, this field is empty/ignored. When creating or updating a booking, only the id of a resource is required. Any name passed is ignored. If not specified when creating or updating a booking, Bookeo will automatically assign available resources.,
            'canceled'                    => 'boolean',            // Whether this booking is canceled [read-only],
            'cancelationTime'             => 'string:datetime',    // If the booking is cancelled, this is the time when it was cancelled [read-only],
            'cancelationAgent'            => 'string',             // If the booking is cancelled, this is the person who cancelled [read-only],
            'accepted'                    => 'boolean',            // Whether this booking was accepted. If no accept/deny was applicable to the booking, the booking is considered accepted as created. [read-only],
            'sourceIp'                    => 'string',             // The IP address from where this booking was created,
            'creationTime'                => 'string:datetime',    // The time when the booking was created [read-only],
            'creationAgent'               => 'string',             // The person that created the booking [read-only],
            'lastChangeTime'              => 'string:datetime',    // The time when the booking was last updated. If the booking was never changed after creation, this field is not present. [read-only],
            'lastChangeAgent'             => 'string',             // The person who last updated this booking. If the booking was never changed after creation, this field is not present. [read-only],
            'productName'                 => 'string',             // The name of the product this booking is for [read-only],
            'productId'                   => 'string',             // The id of the product this booking is for. For a full list of products and their ids, see /settings/products,
            'price'                       => 'Price',              // Details about price, taxes, etc. [read-only],
            'options'                     => 'Array[BookingOption]',
            'privateEvent'                => 'boolean',            // Whether this booking reserves the entire event. Only available for products that allow it.,
            'promotionCodeInput'          => 'string',             // Optional promotion code input, can be used when creating or updating a booking It could be a single code, or a list of codes separated by comma (ex. multiple coupon/voucher codes) In general, applications creating bookings can simply ask the customer to input a promotion code (like they would on Bookeo's web interface) and pass the input in this field. Bookeo will then parse and validate any text entered,
            'promotionName'               => 'string',             // The name of the promotion that was applied to this booking. [read-only],
            'couponCodes'                 => 'string',
            'giftVoucherCodeInput'        => 'string',             // A gift voucher code applicable to this booking. This field is only set by the application, when creating or updating a booking. It is possible to specify multiple codes, separated by commas. No more than one specific (as opposed to "generic", value-based) gift voucher can be used per booking.,
            'specificVoucherCode'         => 'string',             // When the booking used a service specific voucher (i.e. as opposed to a "generic" voucher, based on a fixed amount), the code of the voucher is reported here. [read-only],
            'initialPayments'             => 'Array[Payment]',     // When creating a new booking, an application can also record one or more payment associated to the booking (ex. if the customer has paid a deposit or the full amount online) This field is never set by Bookeo, and is ignored unless this is a new booking being created.
        ];
    }
}
