<?php

namespace ItechSup\ItechSisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Event
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
     * @var \DateTime
     *
     * @ORM\Column(name="startTime", type="datetime")
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     *
     * @ORM\Column(name="endTime", type="datetime")
     */
    private $endTime;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var Session
     *
     * @ORM\ManyToOne(targetEntity="TimeSlot", inversedBy="events")
     */
    private $timeSlot;

    /**
     * @var Room
     *
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="events")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id", nullable=false)
     */
    private $room;

    /**
     * @var Teacher
     *
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="events")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id", nullable=false)
     */
    private $teacher;

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
     * @return Event
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
     * @return Event
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
     * Set title
     *
     * @param string $title
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set session
     *
     * @param \ItechSup\ItechSisBundle\Entity\Session $session
     * @return Event
     */
    public function setSession(\ItechSup\ItechSisBundle\Entity\Session $session = null)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return \ItechSup\ItechSisBundle\Entity\Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set room
     *
     * @param \ItechSup\ItechSisBundle\Entity\Room $room
     * @return Event
     */
    public function setRoom(\ItechSup\ItechSisBundle\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \ItechSup\ItechSisBundle\Entity\Room
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set teacher
     *
     * @param \ItechSup\ItechSisBundle\Entity\Teacher $teacher
     * @return Event
     */
    public function setTeacher(\ItechSup\ItechSisBundle\Entity\Teacher $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \ItechSup\ItechSisBundle\Entity\Teacher
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /*
     *
     *@Assert\Callback
     */
    public function validateStartDate(ExecutionContextInterface $context)
    {
        $start = $this->getStartTime();
        $end = $this->getEndTime();

        if ($start > $end) {
            $context->buildViolation('La date de fin doit être supérieure à la date de début ')
                ->atPath('startTime')
                ->addViolation();
        }
    }

    /*
     *
     *
     * @Assert\Callback
     */
    public function validateEventSameDay(ExecutionContextInterface $context)
    {
        $start = $this->getStartTime()->format('dd-mm-yyyy');
        $end = $this->getEndTime()->format('dd-mm-yyyy');

        if ($start != $end) {
            $context->addViolationAt(
                'startTime',
                'Erreur! Un cour doit être sur le même jour ! ',
                array(),
                null
            );
        }
    }

    /**
     * Set timeSlot
     *
     * @param \ItechSup\ItechSisBundle\Entity\TimeSlot $timeSlot
     * @return Event
     */
    public function setTimeSlot(\ItechSup\ItechSisBundle\Entity\TimeSlot $timeSlot = null)
    {
        $this->timeSlot = $timeSlot;

        return $this;
    }

    /**
     * Get timeSlot
     *
     * @return \ItechSup\ItechSisBundle\Entity\TimeSlot 
     */
    public function getTimeSlot()
    {
        return $this->timeSlot;
    }
}
