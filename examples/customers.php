<?php

require_once __DIR__ . '/../vendor/autoload.php';

use \Bookeo\Client;

$client = new Client([
    'secret_key' => 'Ks7yQXbPwNSMoluRH0fT6c5cDQpe4kFX',
    'api_key'    => 'AXHNMCXA33CKTT9H9963R425564NHLTW16D15F8386F'
]);

$result = $client->customers->all('Hello')->exec();
print_r($result);
