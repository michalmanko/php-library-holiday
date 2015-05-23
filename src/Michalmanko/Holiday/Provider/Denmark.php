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
 * Danish Holidays Provider.
 */
class Denmark extends AbstractProvider
{
    /**
     * {@inheritdoc}
     */
    protected function prepareHolidays($year)
    {
        $data = new ArrayObject();

        // New year's day
        $data->append($this->createHoliday('Nytårsdag', $year . '-01-01', Holiday::TYPE_HOLIDAY));

        // Easter Sunday
        $easter = $this->createHoliday('Påskedag', $this->getEaster($year), Holiday::TYPE_HOLIDAY);
        $data->append($easter);

        // Maundy Thursday
        $easterThursday = $this->createHoliday('Skærtorsdag', $easter, Holiday::TYPE_HOLIDAY);
        $easterThursday->modify('-3 days');
        $data->append($easterThursday);

        // Good Friday
        $easterFriday = $this->createHoliday('Langfredag', $easter, Holiday::TYPE_HOLIDAY);
        $easterFriday->modify('-2 days');
        $data->append($easterFriday);

        // Easter Monday
        $easterMonday = $this->createHoliday('2. Påskedag', $easter, Holiday::TYPE_HOLIDAY);
        $easterMonday->modify('+1 day');
        $data->append($easterMonday);

        // Prayer day
        $prayerDay = $this->createHoliday(
            'Store bededag',
            $easter,
            Holiday::TYPE_HOLIDAY
        );
        $prayerDay->modify('+3 weeks +5 days');
        $data->append($prayerDay);

        // Ascension Day
        $ascensionDay = $this->createHoliday(
            'Kristi himmelfartsdag',
            $easter,
            Holiday::TYPE_HOLIDAY
        );
        $ascensionDay->modify('+39 days');
        $data->append($ascensionDay);

        // Pentecost day
        $pentecostDay = $this->createHoliday(
            'Pinsedag',
            $easter,
            Holiday::TYPE_HOLIDAY
        );
        $pentecostDay->modify('+49 days');
        $data->append($pentecostDay);

        // 2. Pentecost day
        $pentecostDay2 = $this->createHoliday(
            '2. Pinsedag',
            $pentecostDay,
            Holiday::TYPE_HOLIDAY
        );
        $pentecostDay2->modify('+1 day');
        $data->append($pentecostDay2);
        
        // Constitution day
        $data->append($this->createHoliday('Grundlovsdag', $year . '-06-5', Holiday::TYPE_HOLIDAY));
        
        // Christmas day
        $data->append($this->createHoliday('Juledag', $year . '-12-25', Holiday::TYPE_HOLIDAY));

        // Boxing Day
        $data->append($this->createHoliday('2. Juledag', $year . '-12-26', Holiday::TYPE_HOLIDAY));

        return $data->getArrayCopy();
    }
}
