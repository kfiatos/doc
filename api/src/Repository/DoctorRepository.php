<?php

namespace App\Repository;

use App\Entity\Doctor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Doctor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Doctor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Doctor[]    findAll()
 * @method Doctor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctorRepository extends ServiceEntityRepository implements DoctorRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doctor::class);
    }

    public function save(Doctor $doctor): void
    {
        //error handling needs to be added
        $this->getEntityManager()->persist($doctor);
        $this->getEntityManager()->flush();
    }

    /**
     * @param string $apiId
     * @return Doctor|null
     */
    public function findByApiId(string $apiId): ?Doctor
    {
        return $this->findOneBy([
            'apiId' => $apiId
        ]);
    }
}
