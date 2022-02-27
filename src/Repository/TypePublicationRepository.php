<?php

namespace App\Repository;

use App\Entity\TypePublication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypePublication|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePublication|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePublication[]    findAll()
 * @method TypePublication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePublicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypePublication::class);
    }

    // /**
    //  * @return TypePublication[] Returns an array of TypePublication objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypePublication
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
