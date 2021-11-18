<?php

namespace App\Repository;

use App\Entity\Doctor;
use App\Entity\Slot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Slot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Slot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Slot[]    findAll()
 * @method Slot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SlotRepository extends ServiceEntityRepository implements SlotRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Slot::class);
    }

    public function save(Slot $slot): void
    {
        $this->getEntityManager()->persist($slot);
        $this->getEntityManager()->flush();
    }

    public function findByDoctorAndStartAndEndTime(
        Doctor $doctor,
        \DateTimeInterface $startTime,
        \DateTimeInterface $endTime
    ): ?Slot {
        return $this->findOneBy([
            'doctor' => $doctor,
            'startTime' => $startTime,
            'endTime' => $endTime
        ]);
    }

}
