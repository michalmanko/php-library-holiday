# Michalmanko/Holiday
Michalmanko/Holiday is a small library to check if a specified date is a holiday in a specific country.

## Requirements
Michalmanko/Holiday requires php >= 5.3.

## Installation

### Composer
The easiest way to install this library is through [composer](http://getcomposer.org/). Just add the following lines to your **composer.json** file:

```json
{
   "require": {
        "michalmanko/holiday": "dev-master"
    }
}
```

### Manually
Another way would be to download this library and configure the autoloading yourself. This library relies on a [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) compatible autoloader for automatic class loading.

## Usage

## Get a provider

```php
$providerByIso = new \Michalmanko\Holiday\HolidayFactory::createProvider('PL');
$providerByCountry = new \Michalmanko\Holiday\HolidayFactory::createProvider('Poland');
$providerByClassName = new \Michalmanko\Holiday\HolidayFactory::createProvider('\\Michalmanko\\Holiday\\Provider\\Poland');
```

You can select provider by two-letter [ISO-3166-1](https://en.wikipedia.org/wiki/ISO_3166-1) country codes, country name or just a class name.

## Check holidays

To check for holidays just create the provider for specific country and call the `getHolidays` method.

```php
$provider = new \Michalmanko\Holiday\HolidayFactory::createProvider('PL');
$holidays = $adapter->getHolidays(new \DateTime('2014-01-01'));
```

If you just need to know if there is a holiday on your date or time period there are `isHoliday` and `hasHolidays` methods, too.

If you need to know all holidays for a specific country you can call the `getHolidaysByYear` method.

## License
Michalmanko\Holiday is licensed under the MIT License, see the [`LICENSE.md`](LICENSE.md) file for more details.

## Changelog
See the [`CHANGELOG.md`](CHANGELOG.md) file for more details.

## Contributing
Michalmanko/Holiday is open source. If you use this library it would be great to get some support for currently not implemented countries which you are familiar with. Pull requests will be reviewed and merged fast.

To create a new Provider please see the [`\Michalmanko\Holiday\Provider\Poland`](src/Michalmanko/Holiday/Provider/Poland.php) class as an example.

## Running Tests
Run a `php composer.phar install` command in the base directory to install the `phpunit` dependency. After that you can simply call `vendor/bin/phpunit tests/` to run the test suite.