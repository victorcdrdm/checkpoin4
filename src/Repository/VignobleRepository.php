<?php

namespace App\Repository;

use App\Entity\Vignoble;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vignoble|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vignoble|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vignoble[]    findAll()
 * @method Vignoble[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VignobleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vignoble::class);
    }

    // /**
    //  * @return Vignoble[] Returns an array of Vignoble objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vignoble
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
