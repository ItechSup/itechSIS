<?php

namespace ItechSup\ItechSisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PeriodicTimeSlot
 *
 * @ORM\Entity
 */
class PeriodicTimeSlot extends TimeSlot
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dayOfWeek", type="datetime")
     */
    private $dayOfWeek;

    /**
     * Set dayOfWeek
     *
     * @param \DateTime $dayOfWeek
     * @return PeriodicTimeSlot
     */
    public function setDayOfWeek($dayOfWeek)
    {
        $this->dayOfWeek = $dayOfWeek;

        return $this;
    }


    /**
     * Get dayOfWeek
     *
     * @return \DateTime 
     */
    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }
}
