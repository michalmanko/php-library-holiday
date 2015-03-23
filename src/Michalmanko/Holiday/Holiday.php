<?php

namespace Michalmanko\Holiday;

use DateTime;
use DateTimeZone;

/**
 * Holiday class.
 */
class Holiday extends DateTime
{
    /**
     * Holiday type - Holiday.
     */
    const TYPE_HOLIDAY = "holiday";

    /**
     * Holiday type - School Holiday.
     */
    const TYPE_SCHOOL_HOLIDAY = "school";

    /**
     * Holiday type - notable.
     */
    const TYPE_NOTABLE = "notable";

    /**
     * Holiday type.
     *
     * @var string
     */
    private $type;

    /**
     * Holiday name.
     *
     * @var string
     */
    private $name;

    /**
     * Creates a new Holiday.
     *
     * @param string       $name     Name
     * @param mixed        $time     Time
     * @param DateTimeZone $timezone (optional) Timezone
     * @param string       $type     (optional) Type
     */
    public function __construct($name, $time, DateTimeZone $timezone = null, $type = self::TYPE_HOLIDAY)
    {
        if ($time instanceof DateTime) {
            $time = $time->format('Y-m-d H:i:s');
        }
        parent::__construct($time, $timezone);

        $this->setName($name);
        $this->setType($type);
    }

    /**
     * Returns the holiday name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the holiday name.
     *
     * @param string $name
     *
     * @return Holiday
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns the holiday type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the holiday type.
     *
     * @param string $type
     *
     * @return Holiday
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
