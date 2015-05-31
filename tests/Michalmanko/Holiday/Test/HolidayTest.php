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
use PHPUnit_Framework_TestCase;

/**
 * @author Michał Mańko <github@michalmanko.com>
 */
class HolidayTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Holiday
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new Holiday('name', '2015-01-01');
    }

    public function testInstance()
    {
        $this->assertInstanceOf('\DateTime', $this->object);
    }

    public function testName()
    {
        $this->assertEquals('name', $this->object->getName());

        $this->assertSame($this->object, $this->object->setName('newName'));

        $this->assertEquals('newName', $this->object->getName());
    }

    public function testType()
    {
        $this->assertEquals(Holiday::TYPE_HOLIDAY, $this->object->getType());

        $this->assertSame($this->object, $this->object->setType(Holiday::TYPE_SCHOOL_HOLIDAY));

        $this->assertEquals(Holiday::TYPE_SCHOOL_HOLIDAY, $this->object->getType());
    }

    public function testConstructDefaultValues()
    {
        $this->assertEquals(Holiday::TYPE_HOLIDAY, $this->object->getType());

        $this->assertEquals(
            date_default_timezone_get(),
            $this->object->getTimezone()->getName()
        );
    }

    public function testInvalidTimeInConstruct()
    {
        $this->setExpectedException(
            '\\Exception',
            'DateTime::__construct(): Failed to parse time string (invalid-date) '
            . 'at position 0 (i): The timezone could not be found in the database'
        );
        new Holiday('name', 'invalid-date');
    }

    public function testInvalidTimezoneInConstruct()
    {
        $this->setExpectedException(
            version_compare(PHP_VERSION, '7', '<')
            ? '\\PHPUnit_Framework_Error'
            : '\\TypeException',
            'Argument 3 passed to Michalmanko\Holiday\Holiday::__construct() '
            . 'must be an instance of DateTimeZone, string given'
        );
        new Holiday('name', '2015-01-01', 'timezone');
    }

    public function testTimeAsDateTimeInConstruct()
    {
        $date = new DateTime('2015-01-01');

        $holiday = new Holiday('name', $date);

        $this->assertEquals($date->getTimestamp(), $holiday->getTimestamp());
    }
}
