<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
class ProductController extends Controller
{

    /**
     * @Route("/", name="product_index", methods="GET")
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', ['products' => $productRepository->findAll()]);
    }

    /**
     * @Route("/new", name="product_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods="GET")
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods="GET|POST")
     */
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_edit', ['id' => $product->getId()]);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_delete", methods="DELETE")
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
        }

        return $this->redirectToRoute('product_index');
    }







    /**
     * @Route("/shop/", methods="GET")
     */
    public function showShop(): Response
    {
        //return $this->render('product/show.html.twig', ['product' => $product]);


        $bestSellers = $this->getBestSeller();
        $products = $this->getAll();
        $modo = 0;
        $admin =1;

        return $this->render('pageBoutique.html.twig',array("bestSellers"=>$bestSellers,"products"=>$products,"modo"=>$modo,"admin"=>$admin));

    }


    /**
     * @Route("/create")
     */
    public function addAction(Request $request) {

        $product = new Product();
        $product->setPopularity(0);

        $repo = $this->getDoctrine()->getRepository(Product::class);
        $categories = $repo->findAllCategories();


        $cat2 = $this->forward('App\Controller\CategoryController::findAll');



        //$cat = array('choices'=> array('conso'=>'false', 'text'=>'false', 'autre'=>'true'));
        $cat = array('choices'=>$categories);

        $form = $this->createFormBuilder($product)
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('price', NumberType::class)
            ->add('category', ChoiceType::class, $cat)
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
     * @Route ("/shop/{category}")
     */
    public function sortByCategory($category){
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->sortByCategory($category);

        /*
        foreach ($products as $product){
            echo $product->getTitle().' ';
        }

        return new Response('belong to the category '.$category);
        */


        $bestSellers = $this->getBestSeller();
        $modo = 0;
        $admin =1;

        return $this->render('pageBoutique.html.twig',array("bestSellers"=>$bestSellers,"products"=>$products,"modo"=>$modo,"admin"=>$admin));
    }


    /**
     * @Route ("/shop/price/up")
     */
    public function sortByPriceAsc(){
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->sortByPriceAsc();

        /*
        foreach ($products as $product){
            echo $product->getTitle().' ';
        }

        return new Response('belong to the category '.$category);
        */


        $bestSellers = $this->getBestSeller();
        $modo = 0;
        $admin =1;

        return $this->render('pageBoutique.html.twig',array("bestSellers"=>$bestSellers,"products"=>$products,"modo"=>$modo,"admin"=>$admin));
    }



    /**
     * @Route ("/shop/price/down")
     */
    public function sortByPriceDesc(){
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->sortByPriceDesc();

        /*
        foreach ($products as $product){
            echo $product->getTitle().' ';
        }

        return new Response('belong to the category '.$category);
        */


        $bestSellers = $this->getBestSeller();
        $modo = 0;
        $admin =1;

        return $this->render('pageBoutique.html.twig',array("bestSellers"=>$bestSellers,"products"=>$products,"modo"=>$modo,"admin"=>$admin));
    }



    public function getAll(){
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->findAll();

        return $products;
    }

    /**
     * @Route("/basket/",name="basket_index")
     */
    public function getBasket(){

        $session = new Session();
        $user = $session->get('user');

        if($user) {
            $repo = $this->getDoctrine()->getRepository(Basket::class);
            $product = $repo->findBasket($user);

            //var_dump($products);
            //var_dump($products);

            /*
            foreach ($products as $prod){
                echo $prod['Title'];
            }*/
            //var_dump($user);
            //return new Response("hi");
            return $this->render('basket/index.html.twig', array('baskets' => $product));
        }
        else{
            return new Response("You must be loged in to consult your basket");
        }
    }

}
