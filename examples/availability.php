<?php

require_once __DIR__ . '/../vendor/autoload.php';

use \Bookeo\Client;
use \Bookeo\Models\MatchingSlotsSearchParameters;

$resova = new Client([
    'secret_key' => 'Ks7yQXbPwNSMoluRH0fT6c5cDQpe4kFX',
    'api_key'    => 'AXHNMCXA33CKTT9H9963R425564NHLTW16D15F8386F'
]);

$result = $resova->availability->slots(null, '2019-09-16T00:00:00Z', '2019-09-18T23:59:59Z')->exec();
print_r($result);

$search = new MatchingSlotsSearchParameters();
$search->productId = 'unique-id-of-product';

$result = (string) $resova->availability->matching_slots->search($search)->exec();
print_r($result);

$result = (string) $resova->availability->matching_slots()->exec();
print_r($result);
