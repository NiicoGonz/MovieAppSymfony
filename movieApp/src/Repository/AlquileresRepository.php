<?php

namespace App\Repository;

use App\Entity\Alquileres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Alquileres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alquileres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alquileres[]    findAll()
 * @method Alquileres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlquileresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alquileres::class);
    }

    // /**
    //  * @return Alquileres[] Returns an array of Alquileres objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Alquileres
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
