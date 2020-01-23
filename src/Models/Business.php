<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class Business
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class Business extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'id'               => 'string',             // The unique id for this business(Bookeo account) [read - only],
            'name'             => 'string',             // [read - only],
            'legalIdentifiers' => 'string, optional',   // Tax ID, Vat ID, other legal identifiers [read - only],
            'phoneNumbers'     => 'Array[PhoneNumber]', // [read - only],
            'websiteURL'       => 'string, optional',   // [read - only],
            'emailAddress'     => 'string, optional',   // [read - only],
            'streetAddress'    => 'StreetAddress',      // [read - only],
            'logo'             => 'Image, optional',    // [read - only],
            'description'      => 'string, optional',   // A description of the business, provided by the business itself . The content is in HTML . [read - only]
        ];
    }
}