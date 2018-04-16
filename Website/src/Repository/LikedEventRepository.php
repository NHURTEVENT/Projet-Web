<?php

namespace App\Repository;

use App\Entity\LikedEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LikedEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikedEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikedEvent[]    findAll()
 * @method LikedEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikedEventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LikedEvent::class);
    }

//    /**
//     * @return LikedEvent[] Returns an array of LikedEvent objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LikedEvent
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
