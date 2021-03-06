<?php

namespace ItechSup\ItechSisBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * School
 *
 * @ORM\Table()
 * @ORM\Entity()
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
     * @ORM\ManyToMany(targetEntity="Room")
     */
    private $rooms;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Formation", mappedBy="school")
     */
    private $formations;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Teacher")
     */
    private $teachers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rooms = new ArrayCollection();
        $this->formations = new ArrayCollection();
        $this->teachers = new ArrayCollection();
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
     * @return School
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get openingHour
     *
     * @return \DateTime
     */
    public function getOpeningHour()
    {
        return $this->openingHour;
    }

    /**
     * Set openingHour
     *
     * @param \DateTime $openingHour
     * @return School
     */
    public function setOpeningHour($openingHour)
    {
        $this->openingHour = $openingHour;

        return $this;
    }

    /**
     * Get closingHour
     *
     * @return \DateTime
     */
    public function getClosingHour()
    {
        return $this->closingHour;
    }

    /**
     * Set closingHour
     *
     * @param \DateTime $closingHour
     * @return School
     */
    public function setClosingHour($closingHour)
    {
        $this->closingHour = $closingHour;

        return $this;
    }

    /**
     * Add rooms
     *
     * @param \ItechSup\ItechSisBundle\Entity\Room $rooms
     * @return School
     */
    public function addRoom(\ItechSup\ItechSisBundle\Entity\Room $rooms)
    {
        $this->rooms[] = $rooms;

        return $this;
    }

    /**
     * Remove rooms
     *
     * @param \ItechSup\ItechSisBundle\Entity\Room $rooms
     */
    public function removeRoom(\ItechSup\ItechSisBundle\Entity\Room $rooms)
    {
        $this->rooms->removeElement($rooms);
    }

    /**
     * Get rooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Add formations
     *
     * @param \ItechSup\ItechSisBundle\Entity\Formation $formations
     * @return School
     */
    public function addFormation(\ItechSup\ItechSisBundle\Entity\Formation $formations)
    {
        $this->formations[] = $formations;

        return $this;
    }

    /**
     * Remove formations
     *
     * @param \ItechSup\ItechSisBundle\Entity\Formation $formations
     */
    public function removeFormation(\ItechSup\ItechSisBundle\Entity\Formation $formations)
    {
        $this->formations->removeElement($formations);
    }

    /**
     * Get formations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormations()
    {
        return $this->formations;
    }

    /**
     * Add teachers
     *
     * @param \ItechSup\ItechSisBundle\Entity\Teacher $teachers
     * @return School
     */
    public function addTeacher(\ItechSup\ItechSisBundle\Entity\Teacher $teachers)
    {
        $this->teachers[] = $teachers;

        return $this;
    }

    /**
     * Remove teachers
     *
     * @param \ItechSup\ItechSisBundle\Entity\Teacher $teachers
     */
    public function removeTeacher(\ItechSup\ItechSisBundle\Entity\Teacher $teachers)
    {
        $this->teachers->removeElement($teachers);
    }

    /**
     * Get teachers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeachers()
    {
        return $this->teachers;
    }
}
