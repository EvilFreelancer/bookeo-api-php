<?php

namespace Bookeo\Laravel;

use Bookeo\Client;
use Bookeo\Config;

class ClientWrapper
{
    /**
     * Return Resova API client object
     *
     * @param array $params
     *
     * @return \Bookeo\Client
     * @throws \ErrorException
     */
    public function getClient(array $params = []): Client
    {
        $parameters = config('bookeo-api');
        $parameters = array_merge($parameters, $params);
        $config     = new Config($parameters);

        return new Client($config);
    }
}