<?php
namespace Michalmanko\Holiday\Test;

use Michalmanko\Holiday;
use Michalmanko\Holiday\Provider\Denmark;

class DenmarkTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Denmark
     */
    private $provider;

    public function setUp()
    {
        $this->provider = Holiday\HolidayFactory::createProvider('DK');
    }

    public function test_is_correct_provider()
    {
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Denmark', $this->provider);
    }

    /**
     * @dataProvider dataProvider
     * @param string $type
     * @param array $dates
     */
    public function test_dates($type, $dates)
    {
        foreach($dates as $date) {
            $holiday = $this->provider->getHolidays(new \DateTime($date));
            $this->assertTrue(is_array($holiday), 'Fails on ' . $date);
            $this->assertEquals($type, $holiday[0]->getName(), 'Fails on ' . $date);
        }
    }

    public function dataProvider()
    {
        return array(
            array('Nytårsdag', array('2015-01-01', '2020-01-01')),
            array('Palmesøndag', array('2015-03-29', '2020-04-05', '2030-04-14')),
            array('Skærtorsdag', array('2015-04-02', '2020-04-09')),
            array('Langfredag', array('2015-04-03', '2020-04-10')),
            array('Påskedag', array('2015-04-05', '2020-04-12')),
            array('2. påskedag', array('2015-04-06', '2020-04-13')),
            array('Store bededag', array('2015-05-01', '2020-05-08', '2025-05-16')),
            array('Kristi himmelfartsdag', array('2015-05-14', '2020-05-21', '2025-05-29')),
            array('Pinsedag', array('2015-05-24', '2020-05-31', '2025-06-08')),
            array('2. pinsedag', array('2015-05-25', '2020-06-01', '2025-06-09')),
            array('Juledag', array('2015-12-24', '2020-12-24')),
            array('2. juledag', array('2015-12-25', '2020-12-25')),
        );
    }

}
