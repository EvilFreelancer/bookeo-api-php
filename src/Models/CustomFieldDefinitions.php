<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class CustomFieldDefinitions
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class CustomFieldDefinitions extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'choiceFields' => 'Array[ChoiceCustomField]', // A list of choice custom fields. The property is not present if there are no choice fields [read-only],
            'numberFields' => 'Array[NumberCustomField]', // A list of number custom fields. The property is not present if there are no number fields [read-only],
            'onOffFields'  => 'Array[OnOffCustomField]',  // A list of on/off custom fields. The property is not present if there are no on/off fields [read-only],
            'textFields'   => 'Array[TextCustomField]',   // A list of text custom fields. The property is not present if there are no text fields [read-only]
        ];
    }
}
