<?php

namespace ItechSup\ItechSisBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ItechSup\ItechSisBundle\Entity\Formation;
use ItechSup\ItechSisBundle\Entity\Session;
use ItechSup\ItechSisBundle\Entity\Room;
use ItechSup\ItechSisBundle\Entity\Teacher;

class LoadData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $sio = new Formation();
        $sio->setTitle('SIO');
        $manager->persist($sio);
        $cgo = new Formation();
        $cgo->setTitle('CGO');
        $manager->persist($cgo);

        $sessionSio = new Session();
        $sessionSio->setFormation($sio);
        $sessionSio->setStartDate(new \DateTime('2010-01-01'));
        $sessionSio->setEndDate(new \DateTime('2016-01-01'));
        $manager->persist($sessionSio);

        $room1 = new Room();
        $room1->setNumber('1');
        $room1->setSeatsCount(6);
        $room1->setComputersCount(3);
        $manager->persist($room1);

        $nbs = new Teacher();
        $nbs->setFullName('Nicolas Bourgeois');
        $manager->persist($nbs);

        $manager->flush();

    }
}