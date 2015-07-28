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
     * @var string
     *
     * @ORM\Column(name="dayOfWeek", type="integer")
     */
    private $dayOfWeek;

    /**
     * Get dayOfWeek
     *
     * @return \DateTime
     */
    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }

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
     * Convenience method to get exact start DateTime. Or perhaps I should store 'em directly. Nevermind.
     *
     * @return \DateTime
     */
    public function getStartDateTime(\DateTimeInterface $date)
    {
        return new \DateTime($date->format('Y-m-d').' '.$this->getStartTime()->format('H:i:s'));
    }

    /**
     * Convenience method to get exact end DateTime. Or perhaps I should store 'em directly. Nevermind.
     *
     * @return \DateTime
     */
    public function getEndDateTime(\DateTimeInterface $date)
    {
        return new \DateTime($date->format('Y-m-d').' '.$this->getEndTime()->format('H:i:s'));
    }

    public function isPunctual() {
        return false;
    }
}
