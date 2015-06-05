<?php

namespace ItechSup\ItechSisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Room
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Room
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255)
     */
    private $number;

    /**
     * @var integer
     *
     * @ORM\Column(name="seats_count", type="integer")
     */
    private $seatsCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="computers_count", type="integer")
     */
    private $computersCount;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Event", mappedBy="room")
     */
    private $events;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="School", mappedBy="room")
     */
    private $school;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new ArrayCollection();
    }


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
     * Set number
     *
     * @param string $number
     * @return Room
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set seatsCount
     *
     * @param integer $seatsCount
     * @return Room
     */
    public function setSeatsCount($seatsCount)
    {
        $this->seatsCount = $seatsCount;

        return $this;
    }

    /**
     * Get seatsCount
     *
     * @return integer
     */
    public function getSeatsCount()
    {
        return $this->seatsCount;
    }

    /**
     * Set computersCount
     *
     * @param integer $computersCount
     * @return Room
     */
    public function setComputersCount($computersCount)
    {
        $this->computersCount = $computersCount;

        return $this;
    }

    /**
     * Get computersCount
     *
     * @return integer
     */
    public function getComputersCount()
    {
        return $this->computersCount;
    }

    /**
     * Add events
     *
     * @param \ItechSup\ItechSisBundle\Entity\Event $events
     * @return Room
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
