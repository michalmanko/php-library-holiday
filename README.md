# Michalmanko/Holiday
[![Build Status](https://travis-ci.org/michalmanko/php-library-holiday.svg?branch=master)](https://travis-ci.org/michalmanko/php-library-holiday)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/michalmanko/php-library-holiday/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/michalmanko/php-library-holiday/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/michalmanko/php-library-holiday/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/michalmanko/php-library-holiday/?branch=master)

[![Latest Stable Version](https://poser.pugx.org/michalmanko/php-library-holiday/v/stable.svg)](https://packagist.org/packages/michalmanko/php-library-holiday)
[![Latest Unstable Version](https://poser.pugx.org/michalmanko/php-library-holiday/v/unstable.svg)](https://packagist.org/packages/michalmanko/php-library-holiday)

[![License](https://poser.pugx.org/michalmanko/php-library-holiday/license.svg)](https://packagist.org/packages/michalmanko/php-library-holiday)
[![Total Downloads](https://poser.pugx.org/michalmanko/php-library-holiday/downloads.svg)](https://packagist.org/packages/michalmanko/php-library-holiday)
[![Monthly Downloads](https://poser.pugx.org/michalmanko/php-library-holiday/d/monthly.png)](https://packagist.org/packages/michalmanko/php-library-holiday)

Michalmanko/Holiday is a small library to check if a specified date is a holiday in a specific country.

## Requirements
Michalmanko/Holiday requires PHP 5.3.23 or later.

## Installation

### Composer
The easiest way to install this library is through [composer](http://getcomposer.org/). Just add the following lines to your **composer.json** file:

```json
{
   "require": {
        "michalmanko/php-library-holiday": "~0.1.1"
    }
}
```

### Manually
Another way would be to download this library and configure the autoloading yourself. This library relies on a [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) compatible autoloader for automatic class loading.

## Usage

## Get a provider

```php
$providerByIso = \Michalmanko\Holiday\HolidayFactory::createProvider('PL');
$providerByCountry = \Michalmanko\Holiday\HolidayFactory::createProvider('Poland');
$providerByClassName = \Michalmanko\Holiday\HolidayFactory::createProvider('\\Michalmanko\\Holiday\\Provider\\Poland');
```

You can select provider by two-letter [ISO-3166-1](https://en.wikipedia.org/wiki/ISO_3166-1) country codes, country name or just a class name.

## Check holidays

To check for holidays just create the provider for specific country and call the `getHolidays` method.

```php
$provider = \Michalmanko\Holiday\HolidayFactory::createProvider('PL');
$holidays = $provider->getHolidays(new \DateTime('2014-01-01'));
```

If you just need to know if there is a holiday on your date or time period there are `isHoliday` and `hasHolidays` methods, too.

If you need to know all holidays for a specific country you can call the `getHolidaysByYear` method.

## License
Michalmanko\Holiday is licensed under the MIT License, see the [`LICENSE.md`](LICENSE.md) file for more details.

## Changelog
See the [`CHANGELOG.md`](CHANGELOG.md) file for more details.

## Contributing
Michalmanko/Holiday is open source. Everyone is more than welcome to [`contribute`](CONTRIBUTING.md) more of them. If you use this library it would be great to get some support for currently not implemented countries which you are familiar with. Pull requests will be reviewed and merged fast.

To create a new Provider please see the [`\Michalmanko\Holiday\Provider\Poland`](src/Michalmanko/Holiday/Provider/Poland.php) class as an example.

## Running Tests
Run a `php composer install` command in the base directory to install the `phpunit` dependency. After that you can simply call `vendor/bin/phpunit -c phpunit.xml` to run the test suite.
