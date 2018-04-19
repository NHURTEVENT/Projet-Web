<?php

namespace App\Controller;

use App\Entity\Subscription;
use App\Form\SubscriptionType;
use App\Repository\SubscriptionRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subscription")
 */
class SubscriptionController extends Controller
{
    /**
     * @Route("/", name="subscription_index", methods="GET")
     */
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {
        return $this->render('subscription/index.html.twig', ['subscriptions' => $subscriptionRepository->findAll()]);
    }

    /**
     * @Route("/subscribedTo/{eventId}", name="subscribed_index", methods="GET")
     */
    public function listSubscribedToEvent($eventId): Response
    {
        $event = $this->getDoctrine()->getRepository(Event::class)->find($eventId);
        $users = $this->getDoctrine()->getRepository(Subscription::class)->findByEvent($event);

        return $this->render('subscription/index.html.twig', ['subscriptions' => $users]);
    }

    /**
     * @Route("/new", name="subscription_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $subscription = new Subscription();
        $form = $this->createForm(SubscriptionType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subscription);
            $em->flush();

            return $this->redirectToRoute('subscription_index');
        }

        return $this->render('subscription/new.html.twig', [
            'subscription' => $subscription,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{user_id}", name="subscription_show", methods="GET")
     */
    public function show(Subscription $subscription): Response
    {
        return $this->render('subscription/show.html.twig', ['subscription' => $subscription]);
    }

    /**
     * @Route("/{user_id}/edit", name="subscription_edit", methods="GET|POST")
     */
    public function edit(Request $request, Subscription $subscription): Response
    {
        $form = $this->createForm(SubscriptionType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subscription_edit', ['user_id' => $subscription->getUser_id()]);
        }

        return $this->render('subscription/edit.html.twig', [
            'subscription' => $subscription,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{user_id}", name="subscription_delete", methods="DELETE")
     */
    public function delete(Request $request, Subscription $subscription): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subscription->getUser_id(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subscription);
            $em->flush();
        }

        return $this->redirectToRoute('subscription_index');
    }
    /**
     * @Route("/event/{event_id}/subscribe")
     */
    public function subscribe($event_id) {

        $session = new Session();
        $user = $session->get('user');

        $subEvent = new Subscription();
        $subEvent->setUserId($user);
        $subEvent->setEventId($this->retrieveEventById($event_id));

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->persist($subEvent);
        $em->flush();

        return $this->redirect('/event/'.$event_id);
    }

    public function retrieveEventById($event_id) {
        $qb = $this->getDoctrine()->getRepository(Event::class);
        return $qb->find($event_id);
    }

}
