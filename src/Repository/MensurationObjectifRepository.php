<?php

namespace App\Repository;

use App\Entity\MensurationObjectif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MensurationObjectif|null find($id, $lockMode = null, $lockVersion = null)
 * @method MensurationObjectif|null findOneBy(array $criteria, array $orderBy = null)
 * @method MensurationObjectif[]    findAll()
 * @method MensurationObjectif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MensurationObjectifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MensurationObjectif::class);
    }

    // /**
    //  * @return MensurationObjectif[] Returns an array of MensurationObjectif objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MensurationObjectif
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
