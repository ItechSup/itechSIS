<?php

namespace ItechSup\ItechSisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * School
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ItechSup\ItechSisBundle\Entity\SchoolRepository")
 */
class School
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
     * @var \DateTime
     *
     * @ORM\Column(name="openingHour", type="time")
     */
    private $openingHour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="closingHour", type="time")
     */
    private $closingHour;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Room", mappedBy="schools")
     */
    private $rooms;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToOne(targetEntity="Formation", inversedBy="school")
     */
    private $formations;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Teacher", mappedBy="schools")
     */
    private $teachers;

    /**
     * @var ArrayCollection
     *
     */
    private $closingDay;




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
     * @return School
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set openingHours
     *
     * @param \DateTime $openingHours
     * @return School
     */
    public function setOpeningHours($openingHours)
    {
        $this->openingHours = $openingHours;

        return $this;
    }

    /**
     * Get openingHours
     *
     * @return \DateTime
     */
    public function getOpeningHours()
    {
        return $this->openingHours;
    }

    /**
     * Set closingHours
     *
     * @param \DateTime $closingHours
     * @return School
     */
    public function setClosingHours($closingHours)
    {
        $this->closingHours = $closingHours;

        return $this;
    }

    /**
     * Get closingHours
     *
     * @return \DateTime
     */
    public function getClosingHours()
    {
        return $this->closingHours;
    }
}