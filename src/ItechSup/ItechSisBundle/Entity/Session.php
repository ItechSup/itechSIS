<?php

namespace ItechSup\ItechSisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ItechSup\ItechSisBundle\ItechSupItechSisBundle;

/**
 * Session
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Session
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
     * @ORM\Column(name="startDate", type="date")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="date")
     */
    private $endDate;

    /**
     * @var Formation
     *
     * @ORM\ManyToOne(targetEntity="Formation", inversedBy="Session")
     * @ORM\JoinColumn(name="formation_id",referencedColumnName="id")
     */
    private $formation;

    /**
     * @var Student
     *
     * @ORM\OneToMany(targetEntity="Student", mappedBy="Session")
     */
    private $student;

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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Session
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Session
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    public function getTitle()
    {
        return $this ->formation -> title;
    }

    public function setTitle($title)
    {
    $this->title = $title;
        return $this;
    }

    /**
     * Set formation
     *
     * @param \ItechSup\ItechSisBundle\Entity\Formation $formation
     * @return Session
     */
     public function setFormation(\ItechSup\ItechSisBundle\Entity\Formation $formation = null)
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
     * Constructor
     */
    public function __construct()
    {
        $this->student = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add student
     *
     * @param \ItechSup\ItechSisBundle\Entity\Student $student
     * @return Session
     */
    public function addStudent(\ItechSup\ItechSisBundle\Entity\Student $student)
    {
        $this->student[] = $student;

        return $this;
    }

    /**
     * Remove student
     *
     * @param \ItechSup\ItechSisBundle\Entity\Student $student
     */
    public function removeStudent(\ItechSup\ItechSisBundle\Entity\Student $student)
    {
        $this->student->removeElement($student);
    }

    /**
     * Get student
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudent()
    {
        return $this->student;
    }
}
