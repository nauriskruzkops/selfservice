<?php

namespace App\Service;

class CalendarGenerator
{
    /**
     * @var \DateTime
     */
    private $currentDate;

    /**
     * @var int
     */
    private $periodShown = 12;

    /**
     * @return \DateTime
     */
    public function getCurrentDate()
    {
        return $this->currentDate;
    }

    /**
     * @param \DateTime $currentDate
     */
    public function setCurrentDate(\DateTime $currentDate): CalendarGenerator
    {
        $this->currentDate = $currentDate;
        $this->currentDate->setTime(0,0,0);

        return $this;
    }

    /**
     * @return int
     */
    public function getPeriodShown(): int
    {
        return $this->periodShown;
    }

    /**
     * @param int $periodShown
     * @return CalendarGenerator
     */
    public function setPeriodShown(int $periodShown): CalendarGenerator
    {
        $this->periodShown = $periodShown;

        return $this;
    }

    /**
     * @param \DateTime|null $currentDate
     * @return \DatePeriod
     */
    public function generate(\DateTime $currentDate = null): \DatePeriod
    {
        if ($currentDate !== null) {
            $this->setCurrentDate($currentDate);
        }

        $periodStart = clone $this->getCurrentDate();
        $periodStart->modify('first day of this month');

        $begin = clone $periodStart;
        $end = clone $begin;
        $end->modify($this->getPeriodShown() .' month');

        return new \DatePeriod($begin, new \DateInterval('P1M'), $end);
    }
}