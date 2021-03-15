<?php

namespace App\Repository;

use App\Entity\IngredientRecette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IngredientRecette|null find($id, $lockMode = null, $lockVersion = null)
 * @method IngredientRecette|null findOneBy(array $criteria, array $orderBy = null)
 * @method IngredientRecette[]    findAll()
 * @method IngredientRecette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientRecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IngredientRecette::class);
    }

    // /**
    //  * @return IngredientRecette[] Returns an array of IngredientRecette objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IngredientRecette
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
