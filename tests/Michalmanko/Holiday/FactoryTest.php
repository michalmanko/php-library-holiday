<?php

namespace Michalmanko\Holiday\Test;

use Michalmanko\Holiday;

class FactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testPolandProvider()
    {
        $provider = Holiday\HolidayFactory::createProvider('PL');

        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $provider);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Poland', $provider);

        $provider2 = Holiday\HolidayFactory::createProvider('Poland');

        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $provider2);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Poland', $provider2);

        $provider3 = Holiday\HolidayFactory::createProvider('\\Michalmanko\\Holiday\\Provider\\Poland');

        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $provider3);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Poland', $provider3);
    }

    public function testProviderFactoryException()
    {
        $this->setExpectedException(
            '\\Michalmanko\\Holiday\\Exception\\InvalidArgumentException', 'Cannot find Holiday provider class "\\Michalmanko\\Holiday\\FakeProvider\\Poland"'
        );
        Holiday\HolidayFactory::createProvider('\\Michalmanko\\Holiday\\FakeProvider\\Poland');
    }

    public function testProviderFactoryException2()
    {
        $this->setExpectedException(
            '\\Michalmanko\\Holiday\\Exception\\InvalidArgumentException', 'Cannot find Holiday provider class "\\Michalmanko\\Holiday\\Provider\\FakeProvider"'
        );
        Holiday\HolidayFactory::createProvider('FakeProvider');
    }

    public function testProviderFactoryRegistry()
    {
        $this->assertArrayHasKey('PL', Holiday\HolidayFactory::getProviders());
    }

    public function testProviderFactoryRegistryRegister()
    {
        Holiday\HolidayFactory::registerProvider('Test', 'TestProvider');
        $this->assertArrayHasKey('TEST', Holiday\HolidayFactory::getProviders());
    }

    public function testProviderFactoryRegistryUnregister()
    {
        Holiday\HolidayFactory::registerProvider('Test', 'TestProvider');
        Holiday\HolidayFactory::unregisterProvider('TEST');

        $this->setExpectedException(
            '\\Michalmanko\\Holiday\\Exception\\InvalidArgumentException', 'Cannot find Holiday provider class "\\Michalmanko\\Holiday\\Provider\\TEST"'
        );
        Holiday\HolidayFactory::createProvider('TEST');
    }

}
