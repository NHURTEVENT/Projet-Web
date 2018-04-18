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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{

    /**
     * @Route("/product/create")
     */
    public function addAction(Request $request) {

        $product = new Product();
        $product->setPopularity(0);

        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->findAllCategories();

        $form = $this->createFormBuilder($product)
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('price', NumberType::class)
            //->add('category', ChoiceType::class, $products) //doesn't work
            ->add('save', SubmitType::class, array('label' => 'Create product'))
            //TODO combobox catégorie
            ->getForm();

        //echo $this->forward('App\Controller\CategoryController::findAll');
        /*foreach ($products as $prod){
        echo $prod;

        }*/

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return new Response('Product added successfully',array());
        }

        $build['form'] = $form->createView();
        return $this->render('form.html.twig', $build);
    }

    /**
     * @Route("/shop")
     */
    public function showShop()
    {
        $bestSellers = $this->getBestSeller();
        $products = $this->getAll();
        $modo = 0;
        $admin =1;

        return $this->render('pageBoutique.html.twig',array("bestSellers"=>$bestSellers,"products"=>$products,"modo"=>$modo,"admin"=>$admin));
    }

    /**
     * @Route("/bestseller")
     */
    public function getBestSeller(){

        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->findMostPopular();

        /*
        foreach ($products as $product){
            echo $product->getTitle().' ';
        }
        */

        return $products;

        //return new Response('are the 3 best sellers');
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

    public function deleteFromBasket($product,$user){
        $em = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository(Basket::class);
        $basketEntry = $repo->findBasketEntry($user,$product);
        $em->remove($basketEntry);
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

    public function getAll(){
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->findAll();

        return $products;
    }

}