<?php

/*
 * This file is part of the Holiday Library.
 *
 * (c) Michał Mańko <github@michalmanko.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Michalmanko\Holiday\Test\Provider;

use ArrayObject;
use DateTime;
use DateTimeZone;
use Michalmanko\Holiday\Holiday;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

/**
 * @author Michał Mańko <github@michalmanko.com>
 */
class AbstractProviderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    protected $object;

    protected $holiday1;

    protected $holiday2;

    protected $schoolHoliday1;

    protected $schoolHoliday2;

    public function setUp()
    {
        $this->holiday1 = $holiday1 = new Holiday(
            'Holiday 1',
            '2015-01-01',
            null,
            Holiday::TYPE_HOLIDAY
        );
        $this->holiday2 = $holiday2 = new Holiday(
            'Holiday 2',
            '2015-01-10',
            null,
            Holiday::TYPE_HOLIDAY
        );
        $this->schoolHoliday1 = $schoolHoliday1 = new Holiday(
            'School Holiday 1',
            '2015-01-02',
            null,
            Holiday::TYPE_SCHOOL_HOLIDAY
        );
        $this->schoolHoliday2 = $schoolHoliday2 = new Holiday(
            'School Holiday 2',
            '2015-01-01',
            null,
            Holiday::TYPE_SCHOOL_HOLIDAY
        );

        $this->object = $this->getMockForAbstractClass(
            '\\Michalmanko\\Holiday\\Provider\\AbstractProvider'
        );
        $this->object->expects($this->any())
            ->method('prepareHolidays')
            ->withAnyParameters()
            ->willReturnCallback(function () use (
                $holiday1,
                $holiday2,
                $schoolHoliday1,
                $schoolHoliday2
            ) {
                $data = new ArrayObject();

                $data->append($holiday1);
                $data->append($holiday2);
                $data->append($schoolHoliday1);
                $data->append($schoolHoliday2);

                return $data->getArrayCopy();
            });
    }

    public function testGetTimeZone()
    {
        $this->assertNull($this->object->getTimeZone());

        $timezone = new DateTimeZone('Europe/London');

        $mock = $this->getMockForAbstractClass(
            '\\Michalmanko\\Holiday\\Provider\\AbstractProvider',
            array($timezone)
        );

        $this->assertSame($timezone, $mock->getTimeZone());
    }

    public function testCreateHoliday()
    {
        $holiday = $this->object->createHoliday(
            'holidayName',
            '2015-01-01'
        );

        $this->assertInstanceOf(
            '\\Michalmanko\\Holiday\\Holiday',
            $holiday
        );

        $this->assertEquals('holidayName', $holiday->getName());

        $this->assertEquals('2015-01-01', $holiday->format('Y-m-d'));

        $this->assertEquals(date_default_timezone_get(), $holiday->getTimeZone()->getName());

        $this->assertEquals(Holiday::TYPE_HOLIDAY, $holiday->getType());
    }

    public function testCreateHolidayWithTimeZone()
    {
        $timezone = new DateTimeZone('Europe/London');

        $mock = $this->getMockForAbstractClass(
            '\\Michalmanko\\Holiday\\Provider\\AbstractProvider',
            array($timezone)
        );

        $holiday = $mock->createHoliday(
            'holidayName',
            '2015-01-01'
        );

        $this->assertEquals($timezone->getName(), $holiday->getTimeZone()->getName());
    }

    public function testCreateHolidayWithType()
    {
        $holiday = $this->object->createHoliday(
            'holidayName',
            '2015-01-01',
            Holiday::TYPE_SCHOOL_HOLIDAY
        );

        $this->assertEquals(Holiday::TYPE_SCHOOL_HOLIDAY, $holiday->getType());
    }

    public function testGetEaster()
    {
        $getEaster = self::getMethod('getEaster');
        $easter    = $getEaster->invokeArgs($this->object, array(2015));

        $this->assertEquals('2015-04-05', $easter->format('Y-m-d'));
    }

    public function testGetHolidaysByYear()
    {
        $this->object->expects($this->once())
            ->method('prepareHolidays')
            ->with(2015);

        $this->object->getHolidaysByYear(2015);
        $holidays = $this->object->getHolidaysByYear(2015);

        $this->assertSame(
            array(
                $this->holiday1,
                $this->holiday2,
                $this->schoolHoliday1,
                $this->schoolHoliday2,
            ),
            $holidays
        );
    }

    public function testGetHolidaysByYearWithArrayObject()
    {
        $mock = $this->getMockForAbstractClass(
            '\\Michalmanko\\Holiday\\Provider\\AbstractProvider'
        );
        $mock->expects($this->any())
            ->method('prepareHolidays')
            ->withAnyParameters()
            ->willReturn(new ArrayObject());

        $mock->getHolidaysByYear(2015);
    }

    public function testGetHolidaysByYearWithInvalidData()
    {
        $mock = $this->getMockForAbstractClass(
            '\\Michalmanko\\Holiday\\Provider\\AbstractProvider'
        );
        $this->setExpectedException(
            '\\Michalmanko\\Holiday\\Provider\\Exception\\UnexpectedValueException',
            sprintf(
                'Method %s::prepareHolidays() must returns an array',
                get_class($mock)
            )
        );
        $mock->expects($this->any())
            ->method('prepareHolidays')
            ->withAnyParameters()
            ->willReturn('string');

        $mock->getHolidaysByYear(2015);
    }

    public function testGetHolidaysByYearWithTypeFilter()
    {
        $holidays = $this->object->getHolidaysByYear(2015, Holiday::TYPE_SCHOOL_HOLIDAY);

        $this->assertSame(
            array(
                $this->schoolHoliday1,
                $this->schoolHoliday2,
            ),
            $holidays
        );
    }

    public function testGetHolidays()
    {
        $date          = new DateTime('2015-01-01 12:00:00');
        $dateTimestamp = $date->getTimestamp();

        $holidays = $this->object->getHolidays($date);

        $this->assertEquals($dateTimestamp, $date->getTimestamp());

        $this->assertEquals(
            array(
                $this->holiday1,
                $this->schoolHoliday2,
            ),
            $holidays
        );
    }

    public function testGetHolidaysWithType()
    {
        $date = new DateTime('2015-01-01 12:00:00');

        $holidays = $this->object->getHolidays($date, Holiday::TYPE_SCHOOL_HOLIDAY);

        $this->assertEquals(
            array($this->schoolHoliday2),
            $holidays
        );
    }

    public function testGetHolidaysWithEndDate()
    {
        $dateStart        = new DateTime('2015-01-01 12:00:00');
        $dateEnd          = new DateTime('2015-01-01 14:00:00');
        $dateEndTimestamp = $dateEnd->getTimestamp();

        $holidays = $this->object->getHolidays($dateStart, $dateEnd);

        $this->assertEquals($dateEndTimestamp, $dateEnd->getTimestamp());

        $this->assertEquals(
            array(
                $this->holiday1,
                $this->schoolHoliday2,
            ),
            $holidays
        );
    }

    public function testGetHolidaysWithInvalidEndDate()
    {
        $dateStart = new DateTime('2015-01-01 12:00:00');

        $this->setExpectedException(
            '\\Michalmanko\\Holiday\\Provider\\Exception\\InvalidArgumentException',
            '$endDateOrType must be an instance of \\DateTime'
        );

        $this->object->getHolidays($dateStart, 'invalid-date', Holiday::TYPE_HOLIDAY);
    }

    public function testHasHolidays()
    {
        $this->assertTrue($this->object->hasHolidays(
            new DateTime('2015-01-01'),
            new DateTime('2015-01-02')
        ));

        $this->assertFalse($this->object->hasHolidays(
            new DateTime('2015-02-01'),
            new DateTime('2015-02-02')
        ));
    }

    public function testIsHoliday()
    {
        $this->assertTrue($this->object->isHoliday(
            new DateTime('2015-01-01')
        ));

        $this->assertFalse($this->object->isHoliday(
            new DateTime('2015-02-01')
        ));
    }

    protected static function getMethod($name)
    {
        $class  = new ReflectionClass('\\Michalmanko\\Holiday\\Provider\\AbstractProvider');
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }
}
