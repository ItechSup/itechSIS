<?php

namespace ItechSup\ItechSisBundle\Tests\ToolBox;

class CalendarTest extends \PHPUnit_Framework_TestCase
{
    public function testIsWorkDay()
    {
        $calendar = new \ItechSup\ItechSisBundle\ToolBox\Calendar();

        $ferieFixe = new \DateTime("14-07-2015");
        $this->assertTrue($calendar->isHolyday($ferieFixe));

        $ferieVariable = new \DateTime("06-04-2015");
        $this->assertTrue($calendar->isHolyday($ferieVariable));

        $dimanche = new \DateTime("05-07-2015");
        $this->assertFalse($calendar->isHolyday($dimanche));
        $this->assertTrue($calendar->isWeekEndDay($dimanche));

        $lundi = new \DateTime("06-07-2015"); // :'(
        $this->assertFalse($calendar->isHolyday($lundi));
        $this->assertFalse($calendar->isWeekEndDay($lundi));
    }
}
