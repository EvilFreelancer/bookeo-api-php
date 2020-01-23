<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class Hold
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class Hold extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'id'                          => 'string',          // [read-only],
            'price'                       => 'Price',           // The total price for the booking [read-only],
            'totalPayable'                => 'Money',           // The total amount payable now. This is the total gross price less any applicable credit [read-only],
            'expiration'                  => 'string:datetime', // The time at which this hold will expire [read-only],
            'applicableMoneyCredit'       => 'Money',           // Existing customers can have a "store credit" that Bookeo uses automatically to pay for purchases. This field indicates the credit that would be applied to the booking if it was saved. This field is present only if the hold is being made on behalf of an existing customer. New customers cannot have pre-existing credit [read-only],
            'applicableGiftVoucherCredit' => 'Money',           // Indicates the credit resulting from money gift vouchers that would be applied to the booking if it was saved. This field is present only if some credit is applicable (from a gift voucher being redeemed at this time, or from previous unused gift vouchers if this booking is for an existing customer) [read-only],
            'applicablePrepaidCredits'    => 'integer',         // Indicates the number of prepaid credits that would be applied to the booking if it was saved. Note that if prepaid credits are applicable, the total price would be reduced, and possibly be 0 if the credit can pay for the entire booking. This field is present only if the hold is being made on behalf of an existing customer. New customers cannot have pre-existing credit [read-only]
        ];
    }
}
