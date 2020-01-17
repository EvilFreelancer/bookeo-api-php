<?php

namespace Bookeo\Laravel;

use Illuminate\Support\Facades\Facade;

class ClientFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ClientWrapper::class;
    }
}
