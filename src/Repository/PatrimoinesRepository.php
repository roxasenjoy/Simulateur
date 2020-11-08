<?php

namespace App\Repository;

use App\Entity\Patrimoines;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Patrimoines|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patrimoines|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patrimoines[]    findAll()
 * @method Patrimoines[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatrimoinesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patrimoines::class);
    }

    // /**
    //  * @return Patrimoines[] Returns an array of Patrimoines objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Patrimoines
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
