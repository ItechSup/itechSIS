<?php

namespace ItechSup\ItechSisBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Formation
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="TimeSlot", mappedBy="formation")
     */
    private $timeSlots;

    /**
     * @var School
     *
     * @ORM\ManyToOne(targetEntity="School", inversedBy="formations")
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id", nullable=false)
     */
    private $school;


    /**
     * @ORM\OneToMany(targetEntity="Student", mappedBy="formation")
     */
    protected $students;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
        $this->students = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Formation
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
     * Add sessions
     *
     * @param \ItechSup\ItechSisBundle\Entity\Session $sessions
     * @return Formation
     */
    public function addSession(\ItechSup\ItechSisBundle\Entity\Session $sessions)
    {
        $this->sessions[] = $sessions;

        return $this;
    }

    /**
     * Remove sessions
     *
     * @param \ItechSup\ItechSisBundle\Entity\Session $sessions
     */
    public function removeSession(\ItechSup\ItechSisBundle\Entity\Session $sessions)
    {
        $this->sessions->removeElement($sessions);
    }

    /**
     * Get sessions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /*
     * Get School
     *
     * @return \Doctrine\Common\Collections\Collection
     *
     */
    public function getSchool()
    {
        return $this->school;
    }
    /*
     * Set School
     * @param string $school
     * @return Formation
     */
    public function setSchool($school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Add timeSlots
     *
     * @param \ItechSup\ItechSisBundle\Entity\TimeSlot $timeSlots
     * @return Formation
     */
    public function addTimeSlot(\ItechSup\ItechSisBundle\Entity\TimeSlot $timeSlots)
    {
        $this->timeSlots[] = $timeSlots;

        return $this;
    }

    /**
     * Remove timeSlots
     *
     * @param \ItechSup\ItechSisBundle\Entity\TimeSlot $timeSlots
     */
    public function removeTimeSlot(\ItechSup\ItechSisBundle\Entity\TimeSlot $timeSlots)
    {
        $this->timeSlots->removeElement($timeSlots);
    }

    /**
     * Get timeSlots
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTimeSlots()
    {
        return $this->timeSlots;
    }

    /**
     * Add students
     *
     * @param \ItechSup\ItechSisBundle\Entity\Student $students
     * @return Formation
     */
    public function addStudent(\ItechSup\ItechSisBundle\Entity\Student $students)
    {
        $this->students[] = $students;

        return $this;
    }

    /**
     * Remove students
     *
     * @param \ItechSup\ItechSisBundle\Entity\Student $students
     */
    public function removeStudent(\ItechSup\ItechSisBundle\Entity\Student $students)
    {
        $this->students->removeElement($students);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudents()
    {
        return $this->students;
    }
}
