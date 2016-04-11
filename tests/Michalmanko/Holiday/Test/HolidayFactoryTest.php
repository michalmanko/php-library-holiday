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

        $providerCountry = HolidayFactory::createProvider('Country');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerCountry);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Test\\Provider\\Provider', $providerCountry);

        $providerPoland = HolidayFactory::createProvider('Poland');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerPoland);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Poland', $providerPoland);

        $providerGermany = HolidayFactory::createProvider('Germany');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermany);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermany);

        $providerGermanyBB = HolidayFactory::createProvider('GermanyBB');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanyBB);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanyBB);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanyBB', $providerGermanyBB);

        $providerGermanyBE = HolidayFactory::createProvider('GermanyBE');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanyBE);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanyBE);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanyBE', $providerGermanyBE);

        $providerGermanyBW = HolidayFactory::createProvider('GermanyBW');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanyBW);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanyBW);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanyBW', $providerGermanyBW);

        $providerGermanyBY = HolidayFactory::createProvider('GermanyBY');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanyBY);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanyBY);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanyBY', $providerGermanyBY);

        $providerGermanyHB = HolidayFactory::createProvider('GermanyHB');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanyHB);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanyHB);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanyHB', $providerGermanyHB);

        $providerGermanyHE = HolidayFactory::createProvider('GermanyHE');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanyHE);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanyHE);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanyHE', $providerGermanyHE);

        $providerGermanyHH = HolidayFactory::createProvider('GermanyHH');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanyHH);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanyHH);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanyHH', $providerGermanyHH);

        $providerGermanyMV = HolidayFactory::createProvider('GermanyMV');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanyMV);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanyMV);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanyMV', $providerGermanyMV);

        $providerGermanyNI = HolidayFactory::createProvider('GermanyNI');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanyNI);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanyNI);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanyNI', $providerGermanyNI);

        $providerGermanyNW = HolidayFactory::createProvider('GermanyNW');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanyNW);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanyNW);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanyNW', $providerGermanyNW);

        $providerGermanyRP = HolidayFactory::createProvider('GermanyRP');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanyRP);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanyRP);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanyRP', $providerGermanyRP);

        $providerGermanySH = HolidayFactory::createProvider('GermanySH');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanySH);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanySH);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanySH', $providerGermanySH);

        $providerGermanySL = HolidayFactory::createProvider('GermanySL');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanySL);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanySL);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanySL', $providerGermanySL);

        $providerGermanySN = HolidayFactory::createProvider('GermanySN');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanySN);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanySN);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanySN', $providerGermanySN);

        $providerGermanyST = HolidayFactory::createProvider('GermanyST');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanyST);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanyST);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanyST', $providerGermanyST);

        $providerGermanyTH = HolidayFactory::createProvider('GermanyTH');
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\AbstractProvider', $providerGermanyTH);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\Germany', $providerGermanyTH);
        $this->assertInstanceOf('\\Michalmanko\\Holiday\\Provider\\GermanyTH', $providerGermanyTH);
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
