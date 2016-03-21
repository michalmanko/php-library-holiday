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
 * Baden-Württemberg (state of Germany) Holidays Provider.
 *
 * @author ottowayne <mr.ottowayne@gmail.com>
 */
class GermanyBW extends Germany
{
    protected function prepareHolidays($year)
    {
        /** @var ArrayObject $data */
        $data = new ArrayObject(parent::prepareHolidays($year));

        $data->append($this->getHolidayEpiphandy($year));
        $data->append($this->getHolidayCorpusChristi($year));
        $data->append($this->getHolidayAllSaintsDay($year));
        
        return $data;
    }
}
