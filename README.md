[![Latest Stable Version](https://poser.pugx.org/evilfreelancer/bookeo-api-php/v/stable)](https://packagist.org/packages/evilfreelancer/bookeo-api-php)
[![Build Status](https://travis-ci.org/EvilFreelancer/bookeo-api-php.svg?branch=master)](https://travis-ci.org/EvilFreelancer/bookeo-api-php)
[![Total Downloads](https://poser.pugx.org/evilfreelancer/bookeo-api-php/downloads)](https://packagist.org/packages/evilfreelancer/bookeo-api-php)
[![License](https://poser.pugx.org/evilfreelancer/bookeo-api-php/license)](https://packagist.org/packages/evilfreelancer/bookeo-api-php)
[![Code Climate](https://codeclimate.com/github/EvilFreelancer/bookeo-api-php/badges/gpa.svg)](https://codeclimate.com/github/EvilFreelancer/bookeo-api-php)
[![Code Coverage](https://scrutinizer-ci.com/g/EvilFreelancer/bookeo-api-php/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/EvilFreelancer/bookeo-api-php/?branch=master)
[![Scrutinizer CQ](https://scrutinizer-ci.com/g/evilfreelancer/bookeo-api-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/evilfreelancer/bookeo-api-php/)

# Bookeo API PHP7 client

    composer require evilfreelancer/bookeo-api-php

## Laravel framework support

Bookeo API client is optimized for usage as normal Laravel package, all functional is available via `\BookeoApi` facade,
for access to client object you need instead:

```php
$config = new \Bookeo\Config([
    'api_key'    => 'my-api-key',
    'secret_key' => 'my-secret-key'
]);
$bookeo = new \Bookeo\Client($config);
```

Use:

```php
$bookeo = \BookeoApi::getClient();
```

You also may provide additional parameters to your client by passing array of parameters to `getClient` method:

```php
$bookeo = \BookeoApi::getClient([
    'api_key'    => 'my-api-key',
    'secret_key' => 'my-secret-key'
]);
```

### Laravel installation

Install the package via Composer:

    composer require evilfreelancer/bookeo-api-php

By default the package will automatically register its service provider, but
if you are a happy owner of Laravel version less than 5.3, then in a project, which is using your package
(after composer require is done, of course), add into`providers` block of your `config/app.php`:

```php
'providers' => [
    // ...
    Bookeo\Laravel\ClientServiceProvider::class,
],
```

Optionally, publish the configuration file if you want to change any defaults:

    php artisan vendor:publish --provider="Bookeo\\Laravel\\ClientServiceProvider"


## How to use

```php
require_once __DIR__ . '/../vendor/autoload.php';

use \Bookeo\Client;
use \Bookeo\Models\MatchingSlotsSearchParameters;

$bookeo = new Client([
    'secret_key' => 'xxxxxxx',
    'api_key'    => 'xxxxxxxxxxxxxxxx'
]);

$result = $bookeo->availability->slots(null, '2019-09-16T00:00:00Z', '2019-09-18T23:59:59Z')->exec();
print_r($result);

$search = new MatchingSlotsSearchParameters();
$search->productId = 'unique-id-of-product';

$result = (string) $bookeo->availability->matching_slots->search($search)->exec();
print_r($result);

$result = (string) $bookeo->availability->matching_slots('pageNavigationToken', 1)->exec();
print_r($result);
````

# Links

* https://www.bookeo.com/apiref/index.html
* https://www.bookeo.com/api/
