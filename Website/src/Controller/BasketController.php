<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Form\Basket1Type;
use App\Repository\BasketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/basket")
 */
class BasketController extends Controller
{
    /**
     * @Route("/", name="basket_index", methods="GET")
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
     * @Route("/{user_id}", name="basket_show", methods="GET")
     */
    public function show(Basket $basket): Response
    {
        return $this->render('basket/show.html.twig', ['basket' => $basket]);
    }

    /**
     * @Route("/{user_id}/edit", name="basket_edit", methods="GET|POST")
     */
    public function edit(Request $request, Basket $basket): Response
    {
        $form = $this->createForm(Basket1Type::class, $basket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('basket_edit', ['user_id' => $basket->getUser_id()]);
        }

        return $this->render('basket/edit.html.twig', [
            'basket' => $basket,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{user_id}", name="basket_delete", methods="DELETE")
     */
    public function delete(Request $request, Basket $basket): Response
    {
        if ($this->isCsrfTokenValid('delete'.$basket->getUser_id(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($basket);
            $em->flush();
        }

        return $this->redirectToRoute('basket_index');
    }
}
