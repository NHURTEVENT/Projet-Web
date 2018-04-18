<?php

namespace App\Repository;

use App\Entity\EventForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EventForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventForm[]    findAll()
 * @method EventForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventFormRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EventForm::class);
    }

//    /**
//     * @return EventForm[] Returns an array of EventForm objects
//     */
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
    public function findOneBySomeField($value): ?EventForm
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
