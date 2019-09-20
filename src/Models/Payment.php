<?php

namespace Bookeo\Models;

use Bookeo\Model;

class Payment extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'id'                 => 'string',
            'creationTime'       => 'string:datetime', // When this record was created
            'receivedTime'       => 'string:datetime', //  When this payment was received
            'reason'             => 'string', // Reason for the payment. Shown to customer where appropriate. Ex. "Deposit", "Balance payment", "Additional fee", etc,
            'description'        => 'string', // Indicates what the payment was for (ex. "Booking 1234", "Prepaid package ABC", "Gift voucher XYZ")
            'comment'            => 'string', // An optional comment tracked with the payment. Not shown to customers.
            'amount'             => 'Money',  // The payment amount
            'paymentMethod'      => 'string', // ['creditCard' or 'paypal' or 'bankTransfer' or 'cash' or 'checque' or 'debitCard' or 'existingCredit' or 'accountCredit' or 'moneyVoucher' or 'other']
            'paymentMethodOther' => 'string', // If paymentMethod is 'other', this field is required, and it specifies what other method was used,
            'agent'              => 'string', // Who registered this payment. If this field is not present, it means that the customer paid online on Bookeo's booking page
            'customerId'         => 'string', // The id of customer associated with this payment
            'gatewayName'        => 'string', // The name of the payment gateway that processed the payment (if it was processed by a payment gateway)
            'transactionId'      => 'string', // The transaction number/id as provided by the payment gateway that processed the payment - if any
        ];
    }
}
