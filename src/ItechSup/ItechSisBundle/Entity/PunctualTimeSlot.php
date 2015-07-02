<?php

namespace ItechSup\ItechSisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PunctualTimeSlot
 *
 * @ORM\Entity
 */
class PunctualTimeSlot extends TimeSlot
{

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dayOfWeek", type="datetime")
     */
    private $day;

    /**
     * Set day
     *
     * @param \DateTime $day
     * @return PunctualTimeSlot
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return \DateTime
     */
    public function getDay()
    {
        return $this->day;
    }
 }
