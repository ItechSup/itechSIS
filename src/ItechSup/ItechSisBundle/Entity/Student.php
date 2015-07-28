<?php

namespace ItechSup\ItechSisBundle\Entity;

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
     * @var string
     *
     * @ORM\Column(name="workplace", type="string", length=255)
     */
    private $workplace;
    /**
     * @var Formation
     *
     * @ORM\ManyToOne(targetEntity="Formation", inversedBy="students")
     * @ORM\JoinColumn(name="formation_id", referencedColumnName="id", nullable=false)
     */
    private $formation;

    /**
     * @return string
     */
    public function getWorkplace()
    {
        return $this->workplace;
    }

    /**
     * @param string $workplace
     *
     * @return Student
     */
    public function setWorkplace($workplace)
    {
        $this->workplace = $workplace;

        return $this;
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Get formation
     *
     * @return \ItechSup\ItechSisBundle\Entity\Formation
     */
    public function getFormation()
    {
        return $this->formation;
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
}
