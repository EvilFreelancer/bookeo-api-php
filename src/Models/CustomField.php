<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class CustomField
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class CustomField extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'id'    => 'string', // The id of the field. It must match the id of an existing customer custom field, as returned by a call to GET /settings/customercustomfields When creating or updating a customer, either the id or the name property are required. If both are supplied, Bookeo will only consider the id property.,
            'name'  => 'string', // The name of the field. It must match the name of an existing customer custom field, as returned by a call to GET /settings/customercustomfields When creating or updating a customer, either the id or the name property are required. If both are supplied, Bookeo will only consider the id property.,
            'value' => 'string', // The value of the field. For checkbox-type options, possible values are "true" and "false" For choice fields, this is the name (i.e. plain text) of the chosen value, not the id
        ];
    }

    /**
     * List of required fields
     *
     * @return array
     */
    public function required(): array
    {
        return [
            'value'
        ];
    }
}
