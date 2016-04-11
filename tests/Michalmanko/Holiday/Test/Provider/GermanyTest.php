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

use Michalmanko\Holiday\Holiday;

/**
 * @author ottowayne <mr.ottowayne@gmail.com>
 */
class GermanyTest extends AbstractTestProvider
{
    public function getProviderCountryCode()
    {
        return 'GER';
    }

    public function getProviderCountryName()
    {
        return 'Germany';
    }

    public function getProviderInstanceOf()
    {
        return '\\Michalmanko\\Holiday\\Provider\\Germany';
    }

    public function dataProvider()
    {
        return array(
            ['Neujahr', Holiday::TYPE_HOLIDAY, array('2015-01-01', '2020-01-01')],
            ['Karfreitag', Holiday::TYPE_HOLIDAY, array('2015-04-03', '2020-04-10')],
            ['Ostermontag', Holiday::TYPE_HOLIDAY, array('2015-04-06', '2020-04-13')],
            ['Christi Himmelfahrt', Holiday::TYPE_HOLIDAY, array('2015-05-14', '2020-05-21', '2025-05-29')],
            ['Erster Mai', Holiday::TYPE_HOLIDAY, array('2015-05-01', '2020-05-01', '2025-05-01')],
            ['Pfingstmontag', Holiday::TYPE_HOLIDAY, array('2015-05-25', '2020-06-01', '2025-06-09')],
            ['Tag der Deutschen Einheit', Holiday::TYPE_HOLIDAY, array('2015-10-03', '2020-10-03', '2025-10-03')],
            ['Reformationstag', Holiday::TYPE_HOLIDAY, array('2017-10-31')],
            ['1. Weihnachtstag', Holiday::TYPE_HOLIDAY, array('2015-12-25', '2020-12-25')],
            ['2. Weihnachtstag', Holiday::TYPE_HOLIDAY, array('2015-12-26', '2020-12-26')],
        );
    }

    public function getEasterSundayTestData()
    {
        return ['Ostersonntag', Holiday::TYPE_HOLIDAY, array('2015-04-05', '2020-04-12')];
    }

    public function getPentecostSundayTestData()
    {
        return ['Pfingstsonntag', Holiday::TYPE_HOLIDAY, array('2015-05-24', '2020-05-31')];
    }

    public function getReformationTestData()
    {
        return ['Reformationstag', Holiday::TYPE_HOLIDAY, array('2015-10-31', '2020-10-31')];
    }

    public function getEpiphanyTestData()
    {
        return ['Heilige Drei Könige', Holiday::TYPE_HOLIDAY, array('2015-01-06', '2020-01-06')];
    }

    public function getCorpusChristiTestData()
    {
        return ['Christi Himmelfahrt', Holiday::TYPE_HOLIDAY, array('2015-05-14', '2020-05-21')];
    }

    public function getAllSaintsDayTestData()
    {
        return ['Allerheiligen', Holiday::TYPE_HOLIDAY, array('2015-11-01', '2020-11-01')];
    }

    public function getAssumptionOfTheBlessedVirginMaryTestData()
    {
        return ['Mariä Himmelfahrt', Holiday::TYPE_HOLIDAY, array('2015-08-15', '2020-08-15')];
    }

    public function getBuszUndBettTagTestData()
    {
        return ['Buß- und Bettag', Holiday::TYPE_HOLIDAY, array('2015-11-18', '2020-11-18')];
    }
}
