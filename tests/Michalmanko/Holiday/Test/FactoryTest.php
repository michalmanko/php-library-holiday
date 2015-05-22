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

use Michalmanko\Holiday\HolidayFactory;
use PHPUnit_Framework_TestCase;

class FactoryTest extends PHPUnit_Framework_TestCase
{
    public function testPolandProvider()
    {
        $provider = HolidayFactory::createProvider('PL');

        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $provider);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Poland', $provider);

        $provider2 = HolidayFactory::createProvider('Poland');

        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $provider2);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Poland', $provider2);

        $provider3 = HolidayFactory::createProvider('\\Michalmanko\\Holiday\\Provider\\Poland');

        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $provider3);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Poland', $provider3);
    }

    public function testProviderFactoryException()
    {
        $this->setExpectedException(
            '\\Michalmanko\\Holiday\\Exception\\InvalidArgumentException',
            'Cannot find Holiday provider class "\\Michalmanko\\Holiday\\FakeProvider\\Poland"'
        );
        HolidayFactory::createProvider('\\Michalmanko\\Holiday\\FakeProvider\\Poland');
    }

    public function testProviderFactoryException2()
    {
        $this->setExpectedException(
            '\\Michalmanko\\Holiday\\Exception\\InvalidArgumentException',
            'Cannot find Holiday provider class "\\Michalmanko\\Holiday\\Provider\\FakeProvider"'
        );
        HolidayFactory::createProvider('FakeProvider');
    }

    public function testProviderFactoryRegistry()
    {
        $this->assertArrayHasKey('PL', HolidayFactory::getProviders());
    }

    public function testProviderFactoryRegistryRegister()
    {
        HolidayFactory::registerProvider('Test', 'TestProvider');
        $this->assertArrayHasKey('TEST', HolidayFactory::getProviders());
    }

    public function testProviderFactoryRegistryUnregister()
    {
        HolidayFactory::registerProvider('Test', 'TestProvider');
        HolidayFactory::unregisterProvider('TEST');

        $this->setExpectedException(
            '\\Michalmanko\\Holiday\\Exception\\InvalidArgumentException',
            'Cannot find Holiday provider class "\\Michalmanko\\Holiday\\Provider\\TEST"'
        );
        HolidayFactory::createProvider('TEST');
    }

    public function testProviderFactoryRegistryUnregisterByName()
    {
        $this->assertTrue(HolidayFactory::unregisterProvider('Denmark'));
    }

    public function testProviderFactoryRegistryUnregisterByNameUnknown()
    {
        $this->assertFalse(HolidayFactory::unregisterProvider('Foo'));
    }

    public function testProviderFactoryRegistryRegisterByNamespace()
    {
        HolidayFactory::registerProvider(
            'ProviderTest',
            '\\Michalmanko\\Holiday\\Test\\Provider\\ProviderTest'
        );
        $provider = HolidayFactory::createProvider('ProviderTest');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $provider);
    }

    public function testProviderFactoryRegistryRegisterByNotInstanceOfAbstract()
    {
        $this->setExpectedException('\\Michalmanko\\Holiday\\Exception\\InvalidArgumentException');
        HolidayFactory::registerProvider('NotProviderTest', '\\tests\\Michalmanko\\Holiday\\Test\\Provider\\');
        HolidayFactory::createProvider('NotProviderTest');
    }
}
