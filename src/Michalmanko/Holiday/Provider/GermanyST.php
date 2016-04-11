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
 * Saxony-Anhalt (state of Germany) Holidays Provider.
 *
 * @author ottowayne <mr.ottowayne@gmail.com>
 */
class GermanyST extends Germany
{
    /**
     * {@inheritdoc}
     */
    protected function prepareHolidays($year)
    {
        /** @var ArrayObject $data */
        $data = new ArrayObject(parent::prepareHolidays($year));

        $data->append($this->getHolidayEpiphany($year));
        if ($year != 2017)
            $data->append($this->getHolidayReformationDay($year));

        return $data;
    }
}
