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

/**
 * @author ottowayne <mr.ottowayne@gmail.com>
 */
class GermanyBETest extends GermanyTest
{
    public function getProviderCountryCode()
    {
        return 'GER_BE';
    }

    public function getProviderCountryName()
    {
        return 'GermanyBE';
    }

    public function getProviderInstanceOf()
    {
        return '\\Michalmanko\\Holiday\\Provider\\GermanyBE';
    }

    public function dataProvider()
    {
        $parentData = parent::dataProvider();

        $providerData = array(
            //
        );

        return array_merge($parentData, $providerData);
    }
}
