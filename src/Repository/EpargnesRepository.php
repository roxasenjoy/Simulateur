<?php

namespace App\Repository;

use App\Entity\Epargnes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Epargnes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Epargnes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Epargnes[]    findAll()
 * @method Epargnes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EpargnesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Epargnes::class);
    }

    // /**
    //  * @return Epargnes[] Returns an array of Epargnes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Epargnes
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
