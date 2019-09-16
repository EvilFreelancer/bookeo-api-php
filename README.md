[![Latest Stable Version](https://poser.pugx.org/evilfreelancer/bookeo-api-php/v/stable)](https://packagist.org/packages/evilfreelancer/bookeo-api-php)
[![Build Status](https://travis-ci.org/EvilFreelancer/bookeo-api-php.svg?branch=master)](https://travis-ci.org/EvilFreelancer/bookeo-api-php)
[![Total Downloads](https://poser.pugx.org/evilfreelancer/bookeo-api-php/downloads)](https://packagist.org/packages/evilfreelancer/bookeo-api-php)
[![License](https://poser.pugx.org/evilfreelancer/bookeo-api-php/license)](https://packagist.org/packages/evilfreelancer/bookeo-api-php)
[![Code Climate](https://codeclimate.com/github/EvilFreelancer/bookeo-api-php/badges/gpa.svg)](https://codeclimate.com/github/EvilFreelancer/bookeo-api-php)
[![Code Coverage](https://scrutinizer-ci.com/g/EvilFreelancer/bookeo-api-php/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/EvilFreelancer/bookeo-api-php/?branch=master)
[![Scrutinizer CQ](https://scrutinizer-ci.com/g/evilfreelancer/bookeo-api-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/evilfreelancer/bookeo-api-php/)

# Bookeo API PHP7 client

    composer require evilfreelancer/bookeo-api-php

## How to use

```php
require_once __DIR__ . '/../vendor/autoload.php';

use \Bookeo\Client;
use \Bookeo\Models\MatchingSlotsSearchParameters;

$resova = new Client([
    'secret_key' => 'xxxxxxx',
    'api_key'    => 'xxxxxxxxxxxxxxxx'
]);

$result = $resova->availability->slots(null, '2019-09-16T00:00:00Z', '2019-09-18T23:59:59Z')->exec();
print_r($result);

$search = new MatchingSlotsSearchParameters();
$search->productId = 'unique-id-of-product';

$result = (string) $resova->availability->matching_slots->search($search)->exec();
print_r($result);

$result = (string) $resova->availability->matching_slots('pageNavigationToken', 1)->exec();
print_r($result);
````

# Links

* https://www.bookeo.com/apiref/index.html
* https://www.bookeo.com/api/
