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
     * @ORM\Column(name="day", type="datetime")
     */
    private $day;

    /**
     * Convenience method to get exact start DateTime. Or perhaps I should store 'em directly. Nevermind.
     *
     * @return \DateTime
     */
    public function getStartDateTime()
    {
        return new \DateTime($this->getDay()->format('Y-m-d') . ' ' . $this->getStartTime()->format('H:i:s'));
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
     * Convenience method to get exact end DateTime. Or perhaps I should store 'em directly. Nevermind.
     *
     * @return \DateTime
     */
    public function getEndDateTime()
    {
        return new \DateTime($this->getDay()->format('Y-m-d') . ' ' . $this->getEndTime()->format('H:i:s'));
    }

    public function isPunctual()
    {
        return true;
    }
 }
