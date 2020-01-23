<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class LanguagesList
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class LanguagesList extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'data' => 'Array[Language]', // [read-only]
        ];
    }
}
