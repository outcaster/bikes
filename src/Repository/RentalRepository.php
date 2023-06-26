<?php

namespace App\Repository;

use App\Entity\Bicycle;
use App\Entity\Rental;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RentalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rental::class);
    }

    public function getOccupiedRentals(Bicycle $bike, \DateTime $dateStart, \DateTime $dateEnd): int
    {
        $queryBuilder = $this->createQueryBuilder('r');

        return $queryBuilder->select('COUNT (r)')
            ->where('r.bike = :bike')
            ->andWhere(
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->andX(
                        $queryBuilder->expr()->lte('r.dateStart', ':objectDateStart'),
                        $queryBuilder->expr()->gte('r.dateEnd', ':objectDateStart'),
                    ),
                    $queryBuilder->expr()->andX(
                        $queryBuilder->expr()->lte('r.dateStart', ':objectDateEnd'),
                        $queryBuilder->expr()->gte('r.dateEnd', ':objectDateEnd'),
                    ),
                    $queryBuilder->expr()->andX(
                        $queryBuilder->expr()->gte('r.dateStart', ':objectDateStart'),
                        $queryBuilder->expr()->lte('r.dateEnd', ':objectDateEnd'),
                    )
                )
            )
            ->setParameter('bike', $bike)
            ->setParameter('objectDateStart', $dateStart)
            ->setParameter('objectDateEnd', $dateEnd)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
