<?php

namespace App\Repository\DemandeClinique;

use App\Entity\DemandeClinique\Depot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Depot>
 *
 * @method Depot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Depot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Depot[]    findAll()
 * @method Depot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Depot::class);
    }

    public function findAllByReponseLaPlusRecente(): array
    {
        return $this->createQueryBuilder('d')
            ->leftJoin('d.reponses', 'r')
            ->addSelect('r')
            ->orderBy('r.dateCreation', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
