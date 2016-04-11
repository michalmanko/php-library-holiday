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
class GermanySNTest extends GermanyTest
{
    public function getProviderCountryCode()
    {
        return 'GER_SN';
    }

    public function getProviderCountryName()
    {
        return 'GermanySN';
    }

    public function getProviderInstanceOf()
    {
        return '\\Michalmanko\\Holiday\\Provider\\GermanySN';
    }

    public function dataProvider()
    {
        $parentData = parent::dataProvider();

        $providerData = array(
            $this->getReformationTestData(),
            $this->getBuszUndBettTagTestData(),
        );

        return array_merge($parentData, $providerData);
    }
}
