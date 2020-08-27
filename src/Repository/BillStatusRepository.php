<?php

namespace App\Repository;

use App\Entity\BillStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BillStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method BillStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method BillStatus[]    findAll()
 * @method BillStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BillStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BillStatus::class);
    }

    // /**
    //  * @return BillStatus[] Returns an array of BillStatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BillStatus
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
