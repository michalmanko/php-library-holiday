<?php

/*
 * This file is part of the Holiday Library.
 *
 * (c) Michał Mańko <github@michalmanko.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Michalmanko\Holiday\Test;

use DateTime;
use Michalmanko\Holiday\Holiday;
use Michalmanko\Holiday\HolidayFactory;
use PHPUnit_Framework_TestCase;

class ProviderTest extends PHPUnit_Framework_TestCase
{
    public function testProvider()
    {
        $provider = HolidayFactory::createProvider('PL');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Poland', $provider);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $provider);
    }

    public function testGetHolidaysByYear()
    {
        $provider = HolidayFactory::createProvider('PL');
        $this->assertNotEmpty($provider->getHolidaysByYear(2014));
    }

    public function testGetHolidays()
    {
        $provider = HolidayFactory::createProvider('PL');

        $this->assertCount(1, $provider->getHolidays(new DateTime('2014-01-01')));
        $this->assertCount(1, $provider->getHolidays(new DateTime('2014-01-01'), new DateTime('2014-01-01')));
        $this->assertCount(1, $provider->getHolidays(new DateTime('2014-01-01'), Holiday::TYPE_HOLIDAY));
        $this->assertCount(0, $provider->getHolidays(new DateTime('2014-01-01'), Holiday::TYPE_NOTABLE));

        $this->assertCount(2, $provider->getHolidays(new DateTime('2014-12-25'), new DateTime('2014-12-26')));
        $this->assertCount(2, $provider->getHolidays(
            new DateTime('2014-12-25'),
            new DateTime('2014-12-26'),
            Holiday::TYPE_HOLIDAY
        ));
        $this->assertCount(0, $provider->getHolidays(
            new DateTime('2014-12-25'),
            new DateTime('2014-12-26'),
            Holiday::TYPE_NOTABLE
        ));
    }

    public function testDontModifyDates()
    {
        $provider      = HolidayFactory::createProvider('PL');
        $from          = new DateTime('2014-01-05 12:00:00');
        $to            = new DateTime('2014-01-07 14:00:00');
        $fromTimestamp = $from->getTimestamp();
        $toTimestamp   = $to->getTimestamp();

        $provider->getHolidays($from, $to);
        $this->assertEquals($fromTimestamp, $from->getTimestamp(), 'Start date was modified');
        $this->assertEquals($toTimestamp,   $to->getTimestamp(), 'End date was modified');
    }

    public function testIsHoliday()
    {
        $provider = HolidayFactory::createProvider('PL');
        $this->assertTrue($provider->isHoliday(new DateTime('2014-01-06')));
        $this->assertTrue($provider->isHoliday(new DateTime('2014-01-06'), Holiday::TYPE_HOLIDAY));
        $this->assertFalse($provider->isHoliday(new DateTime('2014-01-06'), Holiday::TYPE_NOTABLE));
    }

    public function testhasHolidays()
    {
        $provider = HolidayFactory::createProvider('PL');
        $this->assertTrue($provider->hasHolidays(new DateTime('2014-01-06'), new DateTime('2014-01-07')));
        $this->assertTrue($provider->hasHolidays(
            new DateTime('2014-01-06'),
            new DateTime('2014-01-07'),
            Holiday::TYPE_HOLIDAY
        ));
        $this->assertFalse($provider->hasHolidays(
            new DateTime('2014-01-06'),
            new DateTime('2014-01-07'),
            Holiday::TYPE_NOTABLE
        ));

        $this->assertFalse($provider->hasHolidays(new DateTime('2014-01-07'), new DateTime('2014-01-08')));
    }
}
