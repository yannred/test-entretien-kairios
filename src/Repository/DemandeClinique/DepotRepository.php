<?php

namespace App\Repository\DemandeClinique;

use App\Entity\DemandeClinique\Depot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

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

    /**
     * Return all Depots with Reponse ordered by Reponse dateCreation
     * @param bool $onlyNotValidateReponse Don't return validated Reponse
     * @return array
     */
    public function findAllByReponseLaPlusRecente(bool $onlyNotValidateReponse = false): array
    {
        $qb = $this->createQueryBuilder('d');

        if ($onlyNotValidateReponse) {
            $qb->leftJoin('d.reponses', 'r', Expr\Join::WITH, 'r.validate = false');
        } else {
            $qb->leftJoin('d.reponses', 'r');
        }

        $qb->addSelect('r')
            ->orderBy('r.dateCreation', 'DESC');

        return $qb->getQuery()->getResult();
    }
}
