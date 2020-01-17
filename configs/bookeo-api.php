<?php

return [
    'api_key'         => '',
    'secret_key'      => '',
    'proxy'           => null,
    'base_uri'        => 'https://api.bookeo.com/v2'
    'user_agent'      => 'Bookeo PHP Client',
    'timeout'         => 20,
    'tries'           => 2,  // Count of tries
    'seconds'         => 10, // Waiting time per each try
    'verbose'         => false,
    'debug'           => false,
    'track_redirects' => false,
    'allow_redirects' => true,
];
