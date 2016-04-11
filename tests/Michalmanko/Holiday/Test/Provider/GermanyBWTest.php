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
class GermanyBWTest extends GermanyTest
{
    public function getProviderCountryCode()
    {
        return 'GER_BW';
    }

    public function getProviderCountryName()
    {
        return 'GermanyBW';
    }

    public function getProviderInstanceOf()
    {
        return '\\Michalmanko\\Holiday\\Provider\\GermanyBW';
    }

    public function dataProvider()
    {
        $parentData = parent::dataProvider();

        $providerData = array(
            $this->getEpiphanyTestData(),
            $this->getCorpusChristiTestData(),
            $this->getAllSaintsDayTestData(),
        );

        return array_merge($parentData, $providerData);
    }
}
