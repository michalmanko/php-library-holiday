<?php

/*
 * This file is part of the Holiday Library.
 *
 * (c) Michał Mańko <github@michalmanko.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Michalmanko\Holiday\Provider;

use ArrayObject;
use Michalmanko\Holiday\Holiday;

/**
 * Polish Holidays Provider.
 */
class Poland extends AbstractProvider
{
    /**
     * {@inheritdoc}
     */
    protected function prepareHolidays($year)
    {
        $data = new ArrayObject();

        // Easter Sunday
        $easter = $this->createHoliday('Pierwszy dzień Wielkiej Nocy', $this->getEaster($year), Holiday::TYPE_HOLIDAY);
        $data->append($easter);
        // Easter Monday
        $easterMonday = $this->createHoliday('Drugi dzień Wielkiej Nocy', $easter, Holiday::TYPE_HOLIDAY);
        $easterMonday->modify('+1 day');
        $data->append($easterMonday);
        // Pentecost Sunday
        $pentecost = $this->createHoliday('Zielone Świątki', $easter, Holiday::TYPE_HOLIDAY);
        $pentecost->modify('+49 days');
        $data->append($pentecost);
        // Corpus Christi
        $corpusChristi = $this->createHoliday('Boże Ciało', $easter, Holiday::TYPE_HOLIDAY);
        $corpusChristi->modify('+60 days');
        $data->append($corpusChristi);
        // New Year's Day
        $data->append($this->createHoliday('Nowy Rok', $year . '-01-01', Holiday::TYPE_HOLIDAY));
        // Epiphany
        $data->append($this->createHoliday('Trzech króli', $year . '-01-06', Holiday::TYPE_HOLIDAY));
        // Labour Day
        $data->append($this->createHoliday('Święto Pracy', $year . '-05-01', Holiday::TYPE_HOLIDAY));
        // Constitution Day
        $data->append($this->createHoliday(
            'Święto Konstytucji Trzeciego Maja',
            $year . '-05-03',
            Holiday::TYPE_HOLIDAY
        ));
        // Assumption of the Blessed Virgin Mary
        $data->append($this->createHoliday(
            'Wniebowzięcie Najświętszej Maryi Panny',
            $year . '-08-15',
            Holiday::TYPE_HOLIDAY
        ));
        // All Saints' Day
        $data->append($this->createHoliday('Dzień Zmarłych', $year . '-11-01', Holiday::TYPE_HOLIDAY));
        // Independence Day
        $data->append($this->createHoliday('Dzień Niepodległości', $year . '-11-11', Holiday::TYPE_HOLIDAY));
        // Christmas Day
        $data->append($this->createHoliday('Boże Narodzenie', $year . '-12-25', Holiday::TYPE_HOLIDAY));
        // Boxing Day
        $data->append($this->createHoliday('Drugi dzień Bożego Narodzenia', $year . '-12-26', Holiday::TYPE_HOLIDAY));

        return $data->getArrayCopy();
    }
}
