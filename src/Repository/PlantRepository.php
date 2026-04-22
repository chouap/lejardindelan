<?php

namespace App\Repository;

use App\Entity\Plant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Plant>
 */
class PlantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plant::class);
    }

    public function findBySearch(string $search): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.commonName LIKE :search')
            ->orWhere('p.scientificName LIKE :search')
            ->orWhere('p.shortDescription LIKE :search')
            ->setParameter('search', '%' . $search . '%')
            ->orderBy('p.commonName', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
