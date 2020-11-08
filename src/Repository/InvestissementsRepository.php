<?php

namespace App\Repository;

use App\Entity\Investissements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Investissements|null find($id, $lockMode = null, $lockVersion = null)
 * @method Investissements|null findOneBy(array $criteria, array $orderBy = null)
 * @method Investissements[]    findAll()
 * @method Investissements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvestissementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Investissements::class);
    }

    // /**
    //  * @return Investissements[] Returns an array of Investissements objects
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
    public function findOneBySomeField($value): ?Investissements
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
