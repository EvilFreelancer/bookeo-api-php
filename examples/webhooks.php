<?php

require_once __DIR__ . '/../vendor/autoload.php';

use \Bookeo\Client;

$resova = new Client([
    'secret_key' => 'Ks7yQXbPwNSMoluRH0fT6c5cDQpe4kFX',
    'api_key'    => 'AXHNMCXA33CKTT9H9963R425564NHLTW16D15F8386F'
]);

$result = $resova->webhooks->all()->exec();
print_r($result);
