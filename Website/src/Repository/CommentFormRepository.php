<?php

namespace App\Repository;

use App\Entity\CommentForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommentForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentForm[]    findAll()
 * @method CommentForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentFormRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommentForm::class);
    }

//    /**
//     * @return CommentForm[] Returns an array of CommentForm objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommentForm
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
