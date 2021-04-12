<?php

namespace App\Repository;

use App\Entity\Mensuration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mensuration|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mensuration|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mensuration[]    findAll()
 * @method Mensuration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MensurationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mensuration::class);
    }

    // /**
    //  * @return Mensuration[] Returns an array of Mensuration objects
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
    public function findOneBySomeField($value): ?Mensuration
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
