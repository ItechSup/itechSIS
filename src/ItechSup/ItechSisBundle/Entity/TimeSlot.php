<?php

namespace ItechSup\ItechSisBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeSlot
 *
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"periodic" = "PeriodicTimeSlot", "punctual" = "PunctualTimeSlot"})
 */
abstract class TimeSlot
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Formation
     *
     * @Assert\NotNull()
     * @ORM\ManyToOne(targetEntity="Formation", inversedBy="timeSlots")
     * @ORM\JoinColumn(name="formation_id", referencedColumnName="id", nullable=false)
     */
    protected $formation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startTime", type="datetime")
     */
    protected $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endTime", type="datetime")
     */
    protected $endTime;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Event", mappedBy="timeSlot")
     */
    private $events;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return TimeSlot
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return TimeSlot
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set formation
     *
     * @param \ItechSup\ItechSisBundle\Entity\Formation $formation
     * @return TimeSlot
     */
    public function setFormation(\ItechSup\ItechSisBundle\Entity\Formation $formation)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return \ItechSup\ItechSisBundle\Entity\Formation 
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * Add events
     *
     * @param \ItechSup\ItechSisBundle\Entity\Event $events
     * @return TimeSlot
     */
    public function addEvent(\ItechSup\ItechSisBundle\Entity\Event $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \ItechSup\ItechSisBundle\Entity\Event $events
     */
    public function removeEvent(\ItechSup\ItechSisBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }
}
