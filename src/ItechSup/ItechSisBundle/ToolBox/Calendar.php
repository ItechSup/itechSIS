<?php

namespace ItechSup\ItechSisBundle\ToolBox;

class Calendar
{
    /**
     * If I want to work if there work today...
     */
    public function isHolyday(\DateTimeInterface $date)
    {
        $year = new \DateTime($date->format("Y"));

        $easter = $this->getEasterDateTime($date->format("Y"));

        $holidays = [
            // French holydays in mm/DD (américain) format
            $year->modify("1/1")->format("m/d"),
            $year->modify("5/1")->format("m/d"),
            $year->modify("5/8")->format("m/d"),
            $year->modify("7/14")->format("m/d"),
            $year->modify("11/1")->format("m/d"),
            $year->modify("11/11")->format("m/d"),
            $year->modify("12/25")->format("m/d"),

            // Those dates are computed from $easter. So easy to handle with PHP.
            $easter->format("m/d"),
            $easter->modify('+1 day')->format("m/d"),
            $easter->modify('+38 days')->format("m/d"),
            $easter->modify('+11 days')->format("m/d"),
        ];

        return in_array($date->format("m/d"), $holidays);
    }

    /**
     * Returns easter date for a given year. Neat.
     */
    private function getEasterDateTime($year) {
        $days = easter_days($year);
        $base = new \DateTime("$year-03-21");

        return $base->add(new \DateInterval("P{$days}D"));
    }

    /**
     * Returns false on saturday and sundays.
     */

    public function isWeekEndDay(\DateTime $date)
    {
        return $date->format("N") > 1;
    }
}
