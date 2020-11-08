<?php

namespace App\Repository;

use App\Entity\Situations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Situations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Situations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Situations[]    findAll()
 * @method Situations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SituationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Situations::class);
    }

    // /**
    //  * @return Situations[] Returns an array of Situations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Situations
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
