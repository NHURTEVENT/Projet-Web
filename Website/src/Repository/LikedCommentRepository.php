<?php

namespace App\Repository;

use App\Entity\LikedComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LikedComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikedComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikedComment[]    findAll()
 * @method LikedComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikedCommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LikedComment::class);
    }

//    /**
//     * @return LikedComment[] Returns an array of LikedComment objects
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
    public function findOneBySomeField($value): ?LikedComment
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
