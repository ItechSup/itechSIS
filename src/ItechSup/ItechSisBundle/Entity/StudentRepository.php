<?php

namespace ItechSup\ItechSisBundle\Entity;

use Doctrine\ORM\EntityRepository;

class StudentRepository extends EntityRepository
{
    public function findUnlistedStudent()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT s FROM ItechSupItechSisBundle:Student s WHERE s.session IS NULL'
            )
            ->getResult();
    }
}
