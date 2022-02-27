<?php

namespace App\Repository;

use App\Entity\Favory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Favory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favory[]    findAll()
 * @method Favory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favory::class);
    }

    // /**
    //  * @return Favory[] Returns an array of Favory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Favory
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
