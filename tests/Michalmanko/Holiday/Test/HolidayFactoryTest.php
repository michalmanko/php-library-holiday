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

/**
 * @author Michał Mańko <github@michalmanko.com>
 */
class HolidayFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreateProvider()
    {
        $provider = HolidayFactory::createProvider(
            '\\Michalmanko\\Holiday\\Test\\Provider\\Provider'
        );

        $this->assertInstanceOf(
            '\\Michalmanko\\Holiday\\Provider\\AbstractProvider',
            $provider
        );
        $this->assertInstanceOf(
            '\\Michalmanko\\Holiday\\Test\\Provider\\Provider',
            $provider
        );

        HolidayFactory::registerProvider(
            'Country',
            '\\Michalmanko\\Holiday\\Test\\Provider\\Provider'
        );

        $provider2 = HolidayFactory::createProvider('Country');

        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $provider2);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Test\\Provider\\Provider', $provider2);

        $provider3 = HolidayFactory::createProvider('Poland');

        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $provider3);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Poland', $provider3);
    }

    public function testProviderFactoryNotFound()
    {
        $this->setExpectedException(
            '\\Michalmanko\\Holiday\\Exception\\InvalidArgumentException',
            'Cannot find Holiday provider class "\\Michalmanko\\Holiday\\FakeProvider\\Provider"'
        );
        HolidayFactory::createProvider('\\Michalmanko\\Holiday\\FakeProvider\\Provider');
    }

    public function testProviderFactoryNotFound2()
    {
        $this->setExpectedException(
            '\\Michalmanko\\Holiday\\Exception\\InvalidArgumentException',
            'Cannot find Holiday provider class "\\Michalmanko\\Holiday\\Provider\\FakeProvider"'
        );
        HolidayFactory::createProvider('FakeProvider');
    }

    public function testProviderFactoryInvalidProvider()
    {
        $this->setExpectedException(
            '\\Michalmanko\\Holiday\\Exception\\InvalidArgumentException',
            'Class "\\Michalmanko\\Holiday\\Test\\Provider\\NotProvider"'
            . ' must be an instance of \\Michalmanko\\Holiday\\Provider\\AbstractProvider'
        );
        HolidayFactory::createProvider('\\Michalmanko\\Holiday\\Test\\Provider\\NotProvider');
    }

    public function testProviderFactoryRegistry()
    {
        $this->assertInternalType('array', HolidayFactory::getProviders());
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
        HolidayFactory::registerProvider('Test', 'TestProvider');
        $this->assertTrue(HolidayFactory::unregisterProvider('Test'));
    }

    public function testProviderFactoryRegistryUnregisterByClassName()
    {
        HolidayFactory::registerProvider('Test', 'TestProvider');
        $this->assertTrue(HolidayFactory::unregisterProvider('TestProvider'));
    }

    public function testProviderFactoryRegistryUnregisterByNameUnknown()
    {
        $this->assertFalse(HolidayFactory::unregisterProvider('Foo'));
    }

    public function testProviderFactoryRegistryRegisterByNamespace()
    {
        HolidayFactory::registerProvider(
            'Provider',
            '\\Michalmanko\\Holiday\\Test\\Provider\\Provider'
        );
        $provider = HolidayFactory::createProvider('Provider');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $provider);
    }

    public function testProviderFactoryRegistryRegisterByNotInstanceOfAbstract()
    {
        $this->setExpectedException('\\Michalmanko\\Holiday\\Exception\\InvalidArgumentException');
        HolidayFactory::registerProvider('NotProvider', '\\Michalmanko\\Holiday\\Test\\Provider\\');
        HolidayFactory::createProvider('NotProvider');
    }
}
