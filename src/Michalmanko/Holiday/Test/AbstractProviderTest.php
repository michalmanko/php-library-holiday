<?php

namespace Michalmanko\Holiday\Test;

use Michalmanko\Holiday\HolidayFactory;
use Michalmanko\Holiday\Provider\AbstractProvider;

/**
 * Abstract provider test class.
 */
abstract class AbstractProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractProvider
     */
    protected $provider;

    public function setUp()
    {
        $this->provider = HolidayFactory::createProvider($this->providerCountryCode);
    }

    public function testIsCorrectProvider()
    {
        $this->assertInstanceOf($this->providerInstanceOf, $this->provider);
    }

    /**
     * @dataProvider dataProvider
     *
     * @param string $name
     * @param string $type
     * @param array  $dates
     */
    public function testDates($name, $type, $dates)
    {
        foreach ($dates as $date) {
            $holidays = $this->provider->getHolidays(new \DateTime($date));
            $this->assertNotCount(0, $holidays, \sprintf('There is no holiday on %s', $date));
            $holiday = array_shift($holidays);
            $this->assertEquals($name, $holiday->getName(), \sprintf('Holiday on %s is not %s', $date, $name));
            $this->assertEquals($type, $holiday->getType(), \sprintf('Holiday on %s is not type of %s', $date, $type));
        }
    }
}
