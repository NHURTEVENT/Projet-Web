<?php

namespace App\Repository;

use App\Entity\LikedPhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LikedPhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikedPhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikedPhoto[]    findAll()
 * @method LikedPhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikedPhotoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LikedPhoto::class);
    }

//    /**
//     * @return LikedPhoto[] Returns an array of LikedPhoto objects
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
    public function findOneBySomeField($value): ?LikedPhoto
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
