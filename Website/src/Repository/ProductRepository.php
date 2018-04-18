<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
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
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllCategories(){
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.category','c')
            ->addSelect('c.category')
            ->orderBy('c.category','DESC')
            ->getQuery();

        return $qb->execute();
    }

    public function findMostPopular() :array {

        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.popularity','DESC')
            ->setMaxResults(3)
            ->getQuery();

        return $qb->execute();


    }

    public function sortByPriceAsc() :array{
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.price','ASC')
            ->getQuery();

        return $qb->execute();
    }


    public function sortByPriceDesc() :array{
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.price','DESC')
            ->getQuery();

        return $qb->execute();
    }


    public function sortByTitle() :array{
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.title','ASC')
            ->getQuery();

        return $qb->execute();
    }


    public function sortByCategory($category) :array{
        //$repo = $this->getDoctrine()->getRepository(Category::class);
        //$catego = $repo->findOneBy(['category'=>$category]);
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.category','c')
            ->addSelect('c')
            ->andWhere('c.category = :category')
            ->setParameter('category', $category)
            ->orderBy('p.title','ASC')
            ->getQuery();

        return $qb->execute();
    }

}
