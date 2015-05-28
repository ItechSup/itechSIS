// src/ItechSup/itechSis/Entity/StudentRepository.php
    namespace ItechSup\ItechSis\Entity;

use Doctrine\ORM\EntityRepository;

class StudentRepository extends EntityRepository
{
    public function findunlistedStudent()
        {
            return $this->getEntityManager()
                ->createQuery(
                    'SELECT s FROM ItechSupItechSis:Student s WHERE session_id IS NULL'
                )
                ->getResult();
    }
}