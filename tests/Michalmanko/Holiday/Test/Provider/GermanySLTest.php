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
class GermanySLTest extends GermanyTest
{
    public function getProviderCountryCode()
    {
        return 'GER_SL';
    }

    public function getProviderCountryName()
    {
        return 'GermanySL';
    }

    public function getProviderInstanceOf()
    {
        return '\\Michalmanko\\Holiday\\Provider\\GermanySL';
    }

    public function dataProvider()
    {
        $parentData = parent::dataProvider();

        $providerData = array(
            $this->getCorpusChristiTestData(),
            $this->getAllSaintsDayTestData(),
            $this->getAssumptionOfTheBlessedVirginMaryTestData(),
        );

        return array_merge($parentData, $providerData);
    }
}
