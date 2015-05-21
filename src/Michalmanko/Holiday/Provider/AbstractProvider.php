<?php

namespace Michalmanko\Holiday\Provider;

use ArrayObject;
use DateTime;
use DateTimeZone;
use Michalmanko\Holiday\Holiday;
use Michalmanko\Holiday\Provider\Exception\InvalidArgumentException;
use Michalmanko\Holiday\Provider\Exception\UnexpectedValueException;

/**
 * Abstract provider class.
 */
abstract class AbstractProvider
{
    /**
     * Timezone.
     *
     * @var DateTimeZone
     */
    protected $timezone;

    /**
     * List of holidays by year.
     *
     * @var array
     */
    private $holidays = array();

    /**
     * @param null|DateTimeZone $timezone (optional) Timezone
     */
    public function __construct(DateTimeZone $timezone = null)
    {
        $this->timezone = $timezone;
    }

    /**
     * Prepare the holidays in given year.
     *
     * @param int $year The year to prepare the holidays for
     *
     * @return array An array of holidays
     */
    abstract protected function prepareHolidays($year);

    /**
     * Returns timezone.
     *
     * @return DateTimeZone
     */
    public function getTimeZone()
    {
        return $this->timezone;
    }

    /**
     * Creates a holiday object based on current timezone.
     *
     * @param string $name Name
     * @param mixed  $time Time
     * @param string $type Type
     *
     * @return Holiday
     */
    public function createHoliday($name, $time, $type = self::TYPE_HOLIDAY)
    {
        return new Holiday($name, $time, $this->getTimeZone(), $type);
    }

    /**
     * Provides a DateTime object that represents easter sunday for this year.<br/>
     * The time is always set to 00:00:00.
     *
     * @param int $year The year for which to calculcate the easter sunday date
     *
     * @throws InvalidArgumentException
     *
     * @return DateTime
     */
    protected function getEaster($year)
    {
        $easter = new DateTime('now', $this->getTimeZone());
        if (false === $easter->setDate($year, 3, 21)) {
            throw new InvalidArgumentException('Invalid year given');
        }
        $easter->setTime(0, 0, 0);
        $easter->modify('+' . \easter_days($year) . 'days');

        return $easter;
    }

    /**
     * Returns the holidays in given year.
     *
     * @param int         $year The year to get the holidays for
     * @param null|string $type (optional) Holiday type
     *
     * @throws InvalidArgumentException
     *
     * @return array An array of Holidays
     */
    public function getHolidaysByYear($year, $type = null)
    {
        // Check if the given year is correct
        $validYearDate = new DateTime();
        if (!$validYearDate->setDate($year, 1, 1)) {
            throw new InvalidArgumentException('Invalid year given');
        }

        if (!isset($this->holidays[$year])) {
            $preparedHolidays = $this->prepareHolidays($year);
            if (\is_object($preparedHolidays) && $preparedHolidays instanceof ArrayObject) {
                $preparedHolidays = $preparedHolidays->getArrayCopy();
            }
            if (!\is_array($preparedHolidays)) {
                throw new UnexpectedValueException(\sprintf(
                    'Method %s::prepareHolidays() must returns an array',
                    \get_class($this)
                ));
            }

            $this->holidays[$year] = $preparedHolidays;
        }

        if ($type !== null) {
            // Note: array_filter preserves keys, so we use array_values to reset array keys
            return \array_values(\array_filter(
                $this->holidays[$year],
                function (Holiday $holiday) use ($type) {
                    return $holiday->getType() === $type;
                }
            ));
        }

        return $this->holidays[$year];
    }

    /**
     * Returns all holidays in the given time period.
     *
     * @param DateTime $startDate     The start date
     * @param mixed    $endDateOrType (optional) The end date or holiday type
     * @param string (optional) Holiday type
     *
     * @return array
     */
    public function getHolidays(DateTime $startDate, $endDateOrType = null, $type = null)
    {
    	$startDate = clone $startDate;
        $startDate->setTime(0, 0, 0);

        if ($endDateOrType !== null && !($endDateOrType instanceof DateTime)) {
            if ($type !== null) {
                throw new InvalidArgumentException('$endDateOrType must be an instance of \DateTime');
            }
            $type          = $endDateOrType;
            $endDateOrType = clone $startDate;
        } elseif ($endDateOrType === null) {
            $endDateOrType = clone $startDate;
        } else {
        	$endDateOrType = clone $endDateOrType;
        }
        $endDateOrType->setTime(23, 59, 59);

        $startyear = (int) $startDate->format('Y');
        $endyear   = (int) $endDateOrType->format('Y');
        $holidays  = array();
        for ($y = $startyear; $y <= $endyear; $y++) {
            $holidays = \array_merge($holidays, $this->getHolidaysByYear($y, $type));
        }

        // Note: array_filter preserves keys, so we use array_values to reset array keys
        return \array_values(\array_filter(
            $holidays,
            function (Holiday $holiday) use ($startDate, $endDateOrType) {
                return $holiday >= $startDate && $holiday <= $endDateOrType;
            }
        ));
    }

    /**
     * Returns true if any holiday exists in the given time period.
     *
     * @param DateTime      $startDate The start date
     * @param null|DateTime $endDate   (optional) The end date
     * @param null|string   $type      (optional) Holiday type
     *
     * @return boolean
     */
    public function hasHolidays(DateTime $startDate, DateTime $endDate, $type = null)
    {
        return \count($this->getHolidays($startDate, $endDate, $type)) > 0;
    }

    /**
     * Returns true if $date is a holiday.
     *
     * @param DateTime    $date The date
     * @param null|string $type (optional) Holiday type
     *
     * @return boolean
     */
    public function isHoliday(DateTime $date, $type = null)
    {
        return \count($this->getHolidays($date, null, $type)) > 0;
    }
}
