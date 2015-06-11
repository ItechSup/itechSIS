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
     * @ORM\OneToMany(targetEntity="Session", mappedBy="formation")
     */
    private $sessions;

    /**
     * @var School
     *
     * @ORM\ManyToOne(targetEntity="School", inversedBy="formations")
     * @ORM\JoinColumn(name="school_id",referencedColumnName="id")
     */
    private $school;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
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
}
