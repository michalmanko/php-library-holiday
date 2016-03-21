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
 * German Holidays Provider (only contains nationwide holiday).
 *
 * @author ottowayne <mr.ottowayne@gmail.com>
 */
class Germany extends AbstractProvider
{

    /**
     * {@inheritdoc}
     */
    protected function prepareHolidays($year)
    {
        $data = new ArrayObject();

        // New Year's Day
        $data->append($this->createHoliday(
            'Neujahr',
            $year . '-01-01',
            Holiday::TYPE_HOLIDAY
        ));

        // Epiphany (BW, BY, ST)

        // Good Friday
        $goodFriday = $this->createHoliday(
            'Karfreitag',
            $this->getEaster($year),
            Holiday::TYPE_HOLIDAY
        );
        $goodFriday->modify('-2 days');
        $data->append($goodFriday);

        // Easter Sunday (BB, HE)

        // Easter Monday
        $easterMonday = $this->createHoliday(
            'Ostermontag',
            $this->getEaster($year),
            Holiday::TYPE_HOLIDAY
        );
        $easterMonday->modify('+1 day');
        $data->append($easterMonday);

        // Feast of the Ascension
        $feastOfTheAscension = $this->createHoliday(
            'Christi Himmelfahrt',
            $this->getEaster($year),
            Holiday::TYPE_HOLIDAY
        );
        $feastOfTheAscension->modify('+39 day');
        $data->append($feastOfTheAscension);

        // Pentecost Sunday (BB, HE)

        // Pentecost Monday
        $pentecostMonday = $this->createHoliday(
            'Pfingstmontag',
            $this->getEaster($year),
            Holiday::TYPE_HOLIDAY
        );
        $pentecostMonday->modify('+50 days');
        $data->append($pentecostMonday);

        // Corpus Christi (BW, BY, HE, NW, RP, SL)

        // Assumption of the Blessed Virgin Mary (SL)

        // Day of German Unity
        $data->append($this->createHoliday(
            'Tag der Deutschen Einheit',
            $year . '-10-03',
            Holiday::TYPE_HOLIDAY
        ));

        // Labour Day
        $data->append($this->createHoliday(
            'Erster Mai',
            $year . '-05-01',
            Holiday::TYPE_HOLIDAY
        ));

        // Reformation Day (BB, MV, SN, ST, SH, TH)
        // only in the year 2017 is this a nationwide holiday
        // source: https://de.wikipedia.org/wiki/Gesetzliche_Feiertage_in_Deutschland#cite_note-reform2-13
        if ($year == 2017) {
            $data->append($this->getHolidayReformationDay($year));
        }

        // All Saints' Day (BW, BY, NW, RP, SL)

        // Buß- und Bettag (has no English translation, wednesday before the 23.11) (SN)

        // Christmas Day
        $data->append($this->createHoliday(
            '1. Weihnachtstag',
            $year . '-12-25',
            Holiday::TYPE_HOLIDAY
        ));
        
        // Boxing Day
        $data->append($this->createHoliday(
            '2. Weihnachtstag',
            $year . '-12-26',
            Holiday::TYPE_HOLIDAY
        ));

        return $data->getArrayCopy();
    }

    /**
     * @param $year
     * @return Holiday
     */
    public function getHolidayPentecostSunday($year)
    {
        $pentecost = $this->createHoliday('Pfingstsonntag', $this->getEaster($year), Holiday::TYPE_HOLIDAY);
        $pentecost->modify('+49 days');
        return $pentecost;

    }

    /**
     * @param $year
     * @return Holiday
     */
    public function getHolidayEpiphandy($year)
    {
        return $this->createHoliday('Heilige Drei Könige', $year . '-01-06', Holiday::TYPE_HOLIDAY);
    }

    /**
     * @param $year
     * @return Holiday
     */
    public function getHolidayEasterSunday($year)
    {
        return $this->createHoliday('Ostersonntag', $this->getEaster($year), Holiday::TYPE_HOLIDAY);
    }

    public function getHolidayCorpusChristi($year)
    {
        $corpusChristi = $this->createHoliday('Fronleichnam', $this->getEaster($year), Holiday::TYPE_HOLIDAY);
        $corpusChristi->modify('+60 days');
        return $corpusChristi;
    }

    /**
     * @param $year
     * @return Holiday
     */
    public function getHolidayAssumptionOfTheBlessedVirginMary($year)
    {
        return $this->createHoliday('Mariä Himmelfahrt', $year . '-08-15', Holiday::TYPE_HOLIDAY);
    }

    /**
     * Be careful not to add this holiday to states in the year 2017 (nationwide holiday in 2017 only)
     * @param $year
     * @return Holiday
     */
    public function getHolidayReformationDay($year)
    {
        return $this->createHoliday('Reformationstag', $year . '-10-31', Holiday::TYPE_HOLIDAY);
    }

    /**
     * @param $year
     * @return Holiday
     */
    public function getHolidayAllSaintsDay($year)
    {
        return $this->createHoliday('Allerheiligen', $year . '-11-01', Holiday::TYPE_HOLIDAY);
    }

    /**
     * @param $year
     * @return Holiday
     */
    public function getHolidayBuszUndBettTag($year)
    {
        // wednesday before 23-11-yyyy
        $date = date('Y-m-d',strtotime('-1 Wednesday', strtotime($year . '-11-23')));
        return $this->createHoliday('Buß- und Bettag', $date, Holiday::TYPE_HOLIDAY);
    }
}