<?php

namespace Bookeo\Models;

use Bookeo\Model;

/**
 * Class ResourceTypesList
 *
 * @codeCoverageIgnore
 * @package Bookeo\Models
 */
class ResourceTypesList extends Model
{
    /**
     * List of allowed fields
     *
     * @return array
     */
    public function allowed(): array
    {
        return [
            'info' => PaginationInfo::class, // [read-only]
            'data' => 'Array[ResourceType]', // [read-only]
        ];
    }
}