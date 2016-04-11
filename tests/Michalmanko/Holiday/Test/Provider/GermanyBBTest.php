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
class GermanyBBTest extends GermanyTest
{
    public function getProviderCountryCode()
    {
        return 'GER_BB';
    }

    public function getProviderCountryName()
    {
        return 'GermanyBB';
    }

    public function getProviderInstanceOf()
    {
        return '\\Michalmanko\\Holiday\\Provider\\GermanyBB';
    }

    public function dataProvider()
    {
        $parentData = parent::dataProvider();

        $providerData = array(
            $this->getEasterSundayTestData(),
            $this->getPentecostSundayTestData(),
            $this->getReformationTestData(),
        );

        return array_merge($parentData, $providerData);
    }
}
