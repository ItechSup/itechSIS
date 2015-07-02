<?php

namespace ItechSup\ItechSisBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ItechSup\ItechSisBundle\Entity\StudentRepository")
 */
class Student
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;


    /**
     * @var Formation
     *
     * @ORM\ManyToOne(targetEntity="Formation", inversedBy="students")
     */
    private $formation;

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
     * Set name
     *
     * @param string $name
     * @return Student
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /*
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->session;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Student
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set session
     *
     * @param \ItechSup\ItechSisBundle\Entity\Session $session
     * @return Student
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
     * Set formation
     *
     * @param \ItechSup\ItechSisBundle\Entity\Formation $formation
     * @return Student
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
}
