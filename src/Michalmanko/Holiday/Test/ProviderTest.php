<?php

namespace tests\Michalmanko\Holiday;

use Michalmanko\Holiday;

class ProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testProvider()
    {
        $provider = Holiday\HolidayFactory::createProvider('PL');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Poland', $provider);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $provider);
    }

    public function testGetHolidaysByYear()
    {
        $provider = Holiday\HolidayFactory::createProvider('PL');
        $this->assertNotEmpty($provider->getHolidaysByYear(2014));
    }

    public function testGetHolidays()
    {
        $provider = Holiday\HolidayFactory::createProvider('PL');

        $this->assertCount(1, $provider->getHolidays(new \DateTime('2014-01-01')));
        $this->assertCount(1, $provider->getHolidays(new \DateTime('2014-01-01'), new \DateTime('2014-01-01')));
        $this->assertCount(1, $provider->getHolidays(new \DateTime('2014-01-01'), Holiday\Holiday::TYPE_HOLIDAY));
        $this->assertCount(0, $provider->getHolidays(new \DateTime('2014-01-01'), Holiday\Holiday::TYPE_NOTABLE));

        $this->assertCount(2, $provider->getHolidays(new \DateTime('2014-12-25'), new \DateTime('2014-12-26')));
        $this->assertCount(2, $provider->getHolidays(
            new \DateTime('2014-12-25'),
            new \DateTime('2014-12-26'),
            Holiday\Holiday::TYPE_HOLIDAY
        ));
        $this->assertCount(0, $provider->getHolidays(
            new \DateTime('2014-12-25'),
            new \DateTime('2014-12-26'),
            Holiday\Holiday::TYPE_NOTABLE
        ));
    }

    public function testIsHoliday()
    {
        $provider = Holiday\HolidayFactory::createProvider('PL');
        $this->assertTrue($provider->isHoliday(new \DateTime('2014-01-06')));
        $this->assertTrue($provider->isHoliday(new \DateTime('2014-01-06'), Holiday\Holiday::TYPE_HOLIDAY));
        $this->assertFalse($provider->isHoliday(new \DateTime('2014-01-06'), Holiday\Holiday::TYPE_NOTABLE));

    }

    public function testDontModifyDates()
    {
    	$provider = Holiday\HolidayFactory::createProvider('PL');
    	$from = new \DateTime('2014-01-05');
    	$to   = new \DateTime('2014-01-07');
    	$fromTimestamp = $from->getTimestamp();
    	$toTimestamp   = $to->getTimestamp();

    	$this->assertTrue($provider->hasHolidays($from, $to));
    	$this->assertEquals($fromTimestamp, $from->getTimestamp(), 'date was not modified');
    	$this->assertEquals($toTimestamp,   $to->getTimestamp(), 'date was not modified');
    }

    public function testhasHolidays()
    {
        $provider = Holiday\HolidayFactory::createProvider('PL');
        $this->assertTrue($provider->hasHolidays(new \DateTime('2014-01-06'), new \DateTime('2014-01-07')));
        $this->assertTrue($provider->hasHolidays(
            new \DateTime('2014-01-06'),
            new \DateTime('2014-01-07'),
            Holiday\Holiday::TYPE_HOLIDAY
        ));
        $this->assertFalse($provider->hasHolidays(
            new \DateTime('2014-01-06'),
            new \DateTime('2014-01-07'),
            Holiday\Holiday::TYPE_NOTABLE
        ));

        $this->assertFalse($provider->hasHolidays(new \DateTime('2014-01-07'), new \DateTime('2014-01-08')));
    }
}
