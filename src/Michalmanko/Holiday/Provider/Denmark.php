<?php

namespace Michalmanko\Holiday\Provider;

use Michalmanko\Holiday\Holiday;
use ArrayObject;

class Denmark extends AbstractProvider
{

    /**
     * {@inheritdoc}
     */
    protected function prepareHolidays($year)
    {
        $data = new ArrayObject();

        // New years day
        $data->append($this->createHoliday('Nytårsdag', $year . '-01-01', Holiday::TYPE_HOLIDAY));

        // Easter day
        $easter = $this->createHoliday('Påskedag', $this->getEaster($year), Holiday::TYPE_HOLIDAY);
        $data->append($easter);

        // Palm sunday
        $palmsunday = clone $easter;
        $data->append($this->createHoliday('Palmesøndag', $palmsunday->modify('-7 days'), Holiday::TYPE_HOLIDAY));

        // Easter thursday
        $easterthursday = clone $easter;
        $data->append($this->createHoliday('Skærtorsdag', $easterthursday->modify('-3 days'), Holiday::TYPE_HOLIDAY));

        // Easter friday
        $easterfriday = clone $easter;
        $data->append($this->createHoliday('Langfredag', $easterfriday->modify('-2 days'), Holiday::TYPE_HOLIDAY));

        // 2. easter day
        $secondeasterday = clone $easter;
        $data->append($this->createHoliday('2. påskedag', $secondeasterday->modify('+1 day'), Holiday::TYPE_HOLIDAY));

        // Prayer day
        $prayerday = clone $easter;
        $data->append($this->createHoliday('Store bededag', $prayerday->modify('+3 weeks +5 days'), Holiday::TYPE_HOLIDAY));

        // Pentecost day
        $pentecost = clone $easter;
        $data->append($this->createHoliday('Pinsedag', $pentecost->modify('+49 days'), Holiday::TYPE_HOLIDAY));

        // 2. Pentecost day
        $data->append($this->createHoliday('2. pinsedag', $pentecost->modify('+1 day'), Holiday::TYPE_HOLIDAY));

        // Ascension Day
        $data->append($this->createHoliday('Kristi himmelfartsdag', $pentecost->modify('-11 days'), Holiday::TYPE_HOLIDAY));

        // Christmas day
        $data->append($this->createHoliday('Juledag', $year . '-12-24', Holiday::TYPE_HOLIDAY));

        // 2. christmas day
        $data->append($this->createHoliday('2. juledag', $year . '-12-25', Holiday::TYPE_HOLIDAY));

        return $data;
    }

}
