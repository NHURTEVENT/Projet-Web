<?php
/**
 * Created by PhpStorm.
 * User2: Nico
 * Date: 13/04/2018
 * Time: 11:29
 */

namespace App\Controller;

use App\Entity\Basket;
use App\Entity\Category;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function showAction(Product $product)
    {

    }

    /**
     * @Route("/bestseller")
     */
    public function getBestSeller(){

        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->findMostPopular();


        foreach ($products as $product){
            echo $product->getTitle().' ';
        }


        return new Response('are the 3 best sellers');
    }


    /**
     * @Route("/product/create/{title}/{description}/{category}/{price}")
     */
    public function createProduct($title,$description,$category,$price){
        $em = $this->getDoctrine()->getManager();
        $product = new Product();
        $product->setTitle($title);
        $product->setDescription($description);
        $repo = $this->getDoctrine()->getRepository(Category::class);
        $catego = $repo->findOneBy(['category'=>$category]);
        $product->setCategory($catego);
        $product->setPrice($price);
        $product->setPopularity(0);

        $em->persist($product);
        $em->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    /**
     * @Route("product/delete/{id}")
     */
    public function deleteProduct($id){
        $em = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $product = $repo->find($id);
        $em->remove($product);
        $em->flush();

        return new Response('Delete product \''.$product->getTitle().'\' with id '.$id);
    }

    /**
     * @Route("/product/update/{id}/{title}/{description}/{category}/{price}")
     */
    public function updateProduct($id,$title,$description,$category,$price){
        $em = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $product = $repo->find($id);
        if ($title != null){
            $product->setTitle($title);
        }
        if ($description != null) {
            $product->setDescription($description);
        }

        if ($category != null) {
            $repo2 = $this->getDoctrine()->getRepository(Category::class);
            $catego = $repo2->findOneBy(['category' => $category]);
            $product->setCategory($catego);
        }
        if ($price != null) {
            $product->setPrice($price);
        }


        $em->persist($product);
        $em->flush();

        return new Response('Updated product with id '.$product->getId());
    }

    public function addToBasket($product,$user){

        $repo = $this->getDoctrine()->getRepository(Basket::class);
        $basket = $repo->findBasketEntry();

        if($basket){
            $basket->setQuantity($basket->getQuantity()+1);
        }
        else{
            $basket = new Basket();
            $basket->setProductId($product->getId());
            $basket->setUserId($user->getId());
        }
        $em = $this->getDoctrine()->getManager();

        $em->persist($basket);
        $em->flush();
    }


    /**
     * @Route ("/category/{category}")
     */
    public function sortByCategory($category){
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->sortByCategory($category);

        foreach ($products as $product){
            echo $product->getTitle().' ';
        }

        return new Response('belong to the category '.$category);
    }

}