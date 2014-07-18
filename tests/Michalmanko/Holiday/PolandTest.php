<?php

namespace Michalmanko\Holiday\Test;

use Michalmanko\Holiday;

require_once __DIR__ . '/../../../vendor/autoload.php';

class PolandTest extends \PHPUnit_Framework_TestCase
{

    public function testPolandProvider()
    {
        $provider = Holiday\HolidayFactory::createProvider('PL');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Poland', $provider);
    }

    public function testPolandEaster()
    {
        $start = \DateTime::createFromFormat('Y-m-d', "2014-04-20");
        $end = \DateTime::createFromFormat('Y-m-d', "2014-04-21");
        $provider = Holiday\HolidayFactory::createProvider('PL');

        $days = $provider->getHolidays($start, $end);

        $this->assertCount(2, $days);
        $this->assertEquals(
            new Holiday\Holiday('Pierwszy dzień Wielkiej Nocy', '2014-04-20', $provider->getTimeZone(), Holiday\Holiday::TYPE_HOLIDAY), $days[0]);
        $this->assertEquals(
            new Holiday\Holiday('Drugi dzień Wielkiej Nocy', '2014-04-21', $provider->getTimeZone(), Holiday\Holiday::TYPE_HOLIDAY), $days[1]);
    }

    public function testPolandPentecostSunday()
    {
        $date = \DateTime::createFromFormat('Y-m-d', '2014-06-08');
        $provider = Holiday\HolidayFactory::createProvider('PL');

        $days = $provider->getHolidays($date);

        $this->assertCount(1, $days);
        $this->assertEquals(
            new Holiday\Holiday('Zielone Świątki', '2014-06-08', $provider->getTimeZone(), Holiday\Holiday::TYPE_HOLIDAY), $days[0]);
    }

    public function testPolandCorpusChristi()
    {
        $date = \DateTime::createFromFormat('Y-m-d', '2014-06-19');
        $provider = Holiday\HolidayFactory::createProvider('PL');

        $days = $provider->getHolidays($date, Holiday\Holiday::TYPE_HOLIDAY);

        $this->assertCount(1, $days);
        $this->assertEquals(
            new Holiday\Holiday('Boże Ciało', '2014-06-19', $provider->getTimeZone(), Holiday\Holiday::TYPE_HOLIDAY), $days[0]);
    }

}
