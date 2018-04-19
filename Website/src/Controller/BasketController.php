<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Entity\Product;
use App\Form\Basket1Type;
use App\Repository\BasketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/basket")
 */
class BasketController extends Controller
{
    /**
     * @Route("/", name="basket_index2", methods="GET")
     */
    public function index(BasketRepository $basketRepository): Response
    {
        return $this->render('basket/index.html.twig', ['baskets' => $basketRepository->findAll()]);
    }

    /**
     * @Route("/new", name="basket_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $basket = new Basket();
        $form = $this->createForm(Basket1Type::class, $basket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($basket);
            $em->flush();

            return $this->redirectToRoute('basket_index');
        }

        return $this->render('basket/new.html.twig', [
            'basket' => $basket,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{basket}", name="basket_show", methods="GET")
     */
    public function show(Basket $basket): Response
    {
        $session = new Session();
        $user = $session->get('User');
        //once again $basket is id-product missnamed
        $basket2 = $this->getDoctrine()->getRepository(BasketRepository::class)->findBasketEntry($user,$basket);

        return $this->render('basket/show.html.twig', ['basket' => $basket2]);
    }

    /**
     * @Route("/{basket}/edit", name="basket_edit", methods="GET|POST")
     */
    public function edit(Request $request, Basket $basket): Response
    {
        $session = new Session();
        $user = $session->get('user');
        //wrongly named variable, gets the product with corresponding id but id is called basket here
        $product = $this->getDoctrine()->getRepository(Product::class)->find($basket);
        $basket2 = $this->getDoctrine()->getRepository(Basket::class)->findBasketEntry($user,$p);
        $form = $this->createForm(Basket1Type::class, $basket2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('basket_edit', ['user_id' => $basket2->getUser_id()]);
        }

        return $this->render('basket/edit.html.twig', [
            'basket' => $basket2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{basket}", name="basket_delete", methods="DELETE")
     */
    public function delete(Request $request, $basket): Response
    {
        $session = new Session();
        $productEntity = $this->getDoctrine()->getRepository(Product::class)->find($basket);
        $basket2 = $this->getDoctrine()->getRepository(Basket::class)->findBasketEntry($session->get('user'),$productEntity);

        if ($this->isCsrfTokenValid('delete'.$basket2->getProduct_id()->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($basket2);
            $em->flush();


        return $this->redirectToRoute('basket_index');
        }
        else{
            return new Response("invalid token");
        }
    }
}
