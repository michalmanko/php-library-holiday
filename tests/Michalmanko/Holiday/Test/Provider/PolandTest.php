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
 * @author Michał Mańko <github@michalmanko.com>
 */
class PolandTest extends AbstractTestProvider
{
    public function getProviderCountryCode()
    {
        return 'PL';
    }

    public function getProviderCountryName()
    {
        return 'Poland';
    }

    public function getProviderInstanceOf()
    {
        return '\\Michalmanko\\Holiday\\Provider\\Poland';
    }

    public function dataProvider()
    {
        return array(
            array('Nowy Rok', Holiday::TYPE_HOLIDAY, array('2015-01-01', '2020-01-01')),
            array(
                'Pierwszy dzień Wielkiej Nocy',
                Holiday::TYPE_HOLIDAY,
                array('2015-04-05', '2020-04-12'),
            ),
            array(
                'Drugi dzień Wielkiej Nocy',
                Holiday::TYPE_HOLIDAY,
                array('2015-04-06', '2020-04-13'),
            ),
            array('Zielone Świątki', Holiday::TYPE_HOLIDAY, array('2015-05-24')),
            array('Boże Ciało', Holiday::TYPE_HOLIDAY, array('2015-06-04', '2020-06-11')),
            array('Trzech króli', Holiday::TYPE_HOLIDAY, array('2015-01-06', '2020-01-06')),
            array('Święto Pracy', Holiday::TYPE_HOLIDAY, array('2015-05-01', '2020-05-01')),
            array(
                'Święto Konstytucji Trzeciego Maja',
                Holiday::TYPE_HOLIDAY,
                array('2015-05-03', '2020-05-03'),
            ),
            array(
                'Wniebowzięcie Najświętszej Maryi Panny',
                Holiday::TYPE_HOLIDAY,
                array('2015-08-15', '2020-08-15'),
            ),
            array('Dzień Zmarłych', Holiday::TYPE_HOLIDAY, array('2015-11-01', '2020-11-01')),
            array('Dzień Niepodległości', Holiday::TYPE_HOLIDAY, array('2015-11-11', '2020-11-11')),
            array('Boże Narodzenie', Holiday::TYPE_HOLIDAY, array('2015-12-25', '2020-12-25')),
            array(
                'Drugi dzień Bożego Narodzenia',
                Holiday::TYPE_HOLIDAY,
                array('2015-12-26', '2020-12-26'),
            ),
        );
    }
}
