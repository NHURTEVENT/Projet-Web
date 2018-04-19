<?php

namespace App\Repository;

use App\Entity\Basket;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Basket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Basket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Basket[]    findAll()
 * @method Basket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BasketRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Basket::class);
    }

//    /**
//     * @return Basket[] Returns an array of Basket objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Basket
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findBasketEntry($user,$product){
        return $this->createQueryBuilder('b')
               ->where('b.product_id = :product_id')
               ->andWhere('b.user_id = :user_id')
               ->setParameter('user_id', $user)
               ->setParameter('product_id', $product)
               ->getQuery()
               ->getOneOrNullResult();
    }

    public function findBasket(User $user) :array{
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.product_id','b')
            ->where('p.user_id = :user_id')
            ->setParameter('user_id',$user)
            ->getQuery();

        return $qb->execute();
    }
}
