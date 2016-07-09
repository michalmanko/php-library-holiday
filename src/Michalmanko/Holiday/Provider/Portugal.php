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
 * Portuguese Holidays Provider.
 *
 * @author Carlos Cabral <cmpscabral@gmail.com>
 */
class Portugal extends AbstractProvider
{
    /**
     * {@inheritdoc}
     */
    protected function prepareHolidays($year)
    {
        $data = new ArrayObject();

        // New Year's Day
        $data->append($this->createHoliday(
            'Ano Novo',
            $year . '-01-01',
            Holiday::TYPE_HOLIDAY
        ));

        // Easter
        $easter = $this->createHoliday(
            'Páscoa',
            $this->getEaster($year),
            Holiday::TYPE_HOLIDAY
        );
        $data->append($easter);

        // Saint Friday
        $saintFriday = $this->createHoliday(
            'Sexta-Feira Santa',
            $this->getEaster($year),
            Holiday::TYPE_HOLIDAY
        );
        $saintFriday->modify('-2 days');
        $data->append($saintFriday);

        // Liberty day
        $data->append($this->createHoliday(
            '25 de Abril',
            $year . '-04-25',
            Holiday::TYPE_HOLIDAY
        ));

        // Labour Day
        $data->append($this->createHoliday(
            'Dia do Trabalhador',
            $year . '-05-01',
            Holiday::TYPE_HOLIDAY
        ));

        // Corpus Christi
        $corpusChristi = $this->createHoliday(
            'Corpo de Deus',
            $easter,
            Holiday::TYPE_HOLIDAY
        );
        $corpusChristi->modify('+60 days');
        $data->append($corpusChristi);

        // National day
        $data->append($this->createHoliday(
            'Dia de Portugal',
            $year . '-06-10',
            Holiday::TYPE_HOLIDAY
        ));

        // Assumption of the Blessed Virgin Mary
        $data->append($this->createHoliday(
            'Assunção de Nossa Senhora',
            $year . '-08-15',
            Holiday::TYPE_HOLIDAY
        ));

        // Republic day
        $data->append($this->createHoliday(
            'Implantação da República',
            $year . '-10-05',
            Holiday::TYPE_HOLIDAY
        ));

        // All Saints' Day
        $data->append($this->createHoliday(
            'Dia de Todos os Santos',
            $year . '-11-01',
            Holiday::TYPE_HOLIDAY
        ));

        // Independence Day
        $data->append($this->createHoliday(
            'Restauração da Independência',
            $year . '-12-01',
            Holiday::TYPE_HOLIDAY
        ));

        // Immaculate conception
        $data->append($this->createHoliday(
            'Dia da Imaculada Conceição',
            $year . '-12-08',
            Holiday::TYPE_HOLIDAY
        ));

        // Christmas Day
        $data->append($this->createHoliday(
            'Natal',
            $year . '-12-25',
            Holiday::TYPE_HOLIDAY
        ));


        return $data->getArrayCopy();
    }
}
