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

/**
 * Saarland (state of Germany) Holidays Provider.
 *
 * @author ottowayne <mr.ottowayne@gmail.com>
 */
class GermanySL extends Germany
{
    protected function prepareHolidays($year)
    {
        /** @var ArrayObject $data */
        $data = new ArrayObject(parent::prepareHolidays($year));

        $data->append($this->getHolidayCorpusChristi($year));
        $data->append($this->getHolidayAllSaintsDay($year));
        $data->append($this->getHolidayAssumptionOfTheBlessedVirginMary($year));

        return $data;
    }
}
