<?php

namespace Bookeo\Endpoints;

use Bookeo\Client;
use Bookeo\Interfaces\QueryInterface;
use Bookeo\Models\Booking;
use Bookeo\Models\BookingsList;
use Bookeo\Models\Hold;
use Bookeo\Models\HoldCreate;

/**
 * Operations to manage bookings
 *
 * @package Bookeo\Endpoints
 */
class Bookings extends Client
{
    /**
     * Retrieve a booking
     *
     * Retrieve a booking by its booking number
     *
     * @param int         $itemsPerPage         maximum: 100
     * @param string|null $pageNavigationToken
     * @param int         $pageNumber
     * @param string|null $startTime            if specified, only include bookings that start on or after this time. If specified, endTime must be specified as well.
     * @param string|null $endTime              if specified, only include bookings that start on or before this time. If specified, startTime must be specified as well. The maximum allowed interval is 31 days.
     * @param string|null $lastUpdatedStartTime if specified, only include bookings that were last changed (or created) on or after this time. If specified, lastUpdatedEndTime must be specified as well.
     * @param string|null $lastUpdatedEndTime   if specified, only include bookings that were last changed (or created) on or before this time. If specified, lastUpdatedStartTime must be specified as well. The maximum allowed interval is 31 days.
     * @param string|null $productId            if not specified, include bookings for all products. If specified, include only bookings for this product
     * @param bool        $includeCanceled      if true, canceled bookings are included. If false, only bookings that are not canceled are included
     * @param bool        $expandCustomer       if true, the full details of the customer are included (provided the application has read permission over the customer)
     * @param bool        $expandParticipants   if true, full details of the participants are included (provided the application has read permission over the participant)
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function all(
        int $itemsPerPage = 50,
        string $pageNavigationToken = null,
        int $pageNumber = 1,
        string $startTime = null,
        string $endTime = null,
        string $lastUpdatedStartTime = null,
        string $lastUpdatedEndTime = null,
        string $productId = null,
        bool $includeCanceled = false,
        bool $expandCustomer = false,
        bool $expandParticipants = false
    ): QueryInterface {

        if (!empty($itemsPerPage)) {
            $this->appendToQuery('itemsPerPage', $itemsPerPage);
        }
        if (!empty($pageNavigationToken)) {
            $this->appendToQuery('pageNavigationToken', $pageNavigationToken);
        }
        if (!empty($pageNumber)) {
            $this->appendToQuery('pageNumber', $pageNumber);
        }
        if (!empty($startTime)) {
            $this->appendToQuery('startTime', $startTime);
        }
        if (!empty($endTime)) {
            $this->appendToQuery('endTime', $endTime);
        }
        if (!empty($lastUpdatedStartTime)) {
            $this->appendToQuery('lastUpdatedStartTime', $lastUpdatedStartTime);
        }
        if (!empty($lastUpdatedEndTime)) {
            $this->appendToQuery('lastUpdatedEndTime', $lastUpdatedEndTime);
        }
        if (!empty($productId)) {
            $this->appendToQuery('productId', $productId);
        }
        if (!empty($includeCanceled)) {
            $this->appendToQuery('includeCanceled', $includeCanceled);
        }
        if (!empty($expandCustomer)) {
            $this->appendToQuery('expandCustomer', $expandCustomer);
        }
        if (!empty($expandParticipants)) {
            $this->appendToQuery('expandParticipants', $expandParticipants);
        }

        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/bookings?' . $this->getQuery();
        $this->response = BookingsList::class;

        return $this;
    }

    /**
     * Retrieve a booking
     *
     * Retrieve a booking by its booking number
     *
     * @param string $booking_id
     * @param bool   $expandCustomer     if true, the full details of the customer are included (provided the application has read permission over the customer)
     * @param bool   $expandParticipants if true, full details of the participants are included (provided the application has read permission over the participant)
     *
     * @return $this
     */
    public function __invoke(string $booking_id, bool $expandCustomer = false, bool $expandParticipants = false)
    {
        if (!empty($expandCustomer)) {
            $this->appendToQuery('expandCustomer', $expandCustomer);
        }
        if (!empty($expandParticipants)) {
            $this->appendToQuery('expandParticipants', $expandParticipants);
        }

        $this->booking_id = $booking_id;

        // Set HTTP params
        $this->type     = 'get';
        $this->endpoint = '/bookings/' . $booking_id . '?' . $this->getQuery();
        $this->response = Booking::class;

        return $this;
    }

    /**
     * Create a new booking
     *
     * When creating a booking for a product of type "fixed" or "fixedCourse", the eventId is required. eventIds are obtained by calling /availability/slots or /availability/matchingSlots .
     * When creating a booking for a product of type "flexibleTime", you can either specify the eventId or the startTime (in which case you can optionally specify the endTime. If no endTime is specified, Bookeo will automatically calculate the duration based on the options chosen)
     *
     * @param \Bookeo\Models\Booking $create         if specified, deletes the hold with the given id
     * @param string|null            $previousHoldId whether to send a notification email (and possibly SMS, depending on settings) to eligible users
     * @param bool|null              $notifyUsers    whether to send a confirmation email to the customer
     * @param bool|null              $notifyCustomer
     * @param bool|null              $sendCustomerReminders
     * @param bool|null              $sendCustomerThankyou
     * @param string|null            $mode           if present and set to "backend", treats the operation as if it was done by a manager. This relaxes some constraints such as when is it possible to change a booking, participants limits for the booking, booking limits (time in advance), and so on.
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function create(
        Booking $create,
        string $previousHoldId = null,
        bool $notifyUsers = null,
        bool $notifyCustomer = null,
        bool $sendCustomerReminders = null,
        bool $sendCustomerThankyou = null,
        string $mode = null
    ): QueryInterface {

        if (!empty($previousHoldId)) {
            $this->appendToQuery('previousHoldId', $previousHoldId);
        }
        if (null !== $notifyUsers) {
            $this->appendToQuery('notifyUsers', $notifyUsers);
        }
        if (null !== $notifyCustomer) {
            $this->appendToQuery('notifyCustomer', $notifyCustomer);
        }
        if (null !== $sendCustomerReminders) {
            $this->appendToQuery('sendCustomerReminders', $sendCustomerReminders);
        }
        if (null !== $sendCustomerThankyou) {
            $this->appendToQuery('sendCustomerThankyou', $sendCustomerThankyou);
        }
        if (null !== $mode) {
            $this->appendToQuery('mode', $mode);
        }

        // Set HTTP params
        $this->type     = 'post';
        $this->endpoint = '/bookings?' . $this->getQuery();
        $this->params   = $create;
        $this->response = Booking::class;

        return $this;
    }

    /**
     * Update an existing booking
     *
     * @param bool|null   $notifyUsers    if true, notification emails and SMS are sent to authorized users
     * @param bool|null   $notifyCustomer if true, a notification email is sent to the customer
     * @param string|null $mode           if present and set to "backend", treats the operation as if it was done by a manager. This relaxes some constraints such as when is it possible to change a booking, participants limits for the booking, booking limits (time in advance), and so on.
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function update(
        bool $notifyUsers = null,
        bool $notifyCustomer = null,
        string $mode = null
    ): QueryInterface {

        if (null !== $notifyUsers) {
            $this->appendToQuery('notifyUsers', $notifyUsers);
        }
        if (null !== $notifyCustomer) {
            $this->appendToQuery('notifyCustomer', $notifyCustomer);
        }
        if (!empty($mode)) {
            $this->appendToQuery('mode', $mode);
        }

        // Set HTTP params
        $this->type     = 'put';
        $this->endpoint = '/bookings/' . $this->booking_id . '?' . $this->getQuery();

        return $this;
    }

    /**
     * Delete a temporary hold
     *
     * Cancel a booking. Cancelled bookings remain in the system, but no longer show up in the calendar or take up seats.
     *
     * @param bool|null   $notifyUsers             if true, notification emails and SMS are sent to authorized users
     * @param bool|null   $notifyCustomer          if true, a notification email is sent to the customer
     * @param bool|null   $applyCancellationPolicy if true, the default cancellation policy is applied. This may cause a charge on the credit card on file, if a cancellation fee is due
     * @param bool|null   $trackInCustomerHistory  if true, the cancellation will be tracked in the customer's stats
     * @param bool|null   $cancelRemainingSeries   if true, and this booking is part of a recurring series, all following bookings will be cancelled as well
     * @param string|null $reason                  an optional reason that explains why the booking was cancelled
     *
     * @return \Bookeo\Interfaces\QueryInterface
     */
    public function delete(
        bool $notifyUsers = null,
        bool $notifyCustomer = null,
        bool $applyCancellationPolicy = null,
        bool $trackInCustomerHistory = null,
        bool $cancelRemainingSeries = null,
        string $reason = null
    ): QueryInterface {

        if (null !== $notifyUsers) {
            $this->appendToQuery('notifyUsers', $notifyUsers);
        }
        if (null !== $notifyCustomer) {
            $this->appendToQuery('notifyCustomer', $notifyCustomer);
        }
        if (null !== $applyCancellationPolicy) {
            $this->appendToQuery('applyCancellationPolicy', $applyCancellationPolicy);
        }
        if (null !== $trackInCustomerHistory) {
            $this->appendToQuery('trackInCustomerHistory', $trackInCustomerHistory);
        }
        if (null !== $cancelRemainingSeries) {
            $this->appendToQuery('cancelRemainingSeries', $cancelRemainingSeries);
        }
        if (!empty($reason)) {
            $this->appendToQuery('reason', $reason);
        }

        // Set HTTP params
        $this->type     = 'delete';
        $this->endpoint = '/bookings/' . $this->booking_id . '?' . $this->getQuery();

        return $this;
    }
}
