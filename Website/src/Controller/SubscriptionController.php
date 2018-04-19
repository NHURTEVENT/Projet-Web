<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 17/04/2018
 * Time: 14:46
 */

namespace App\Controller;

use App\Entity\Event;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Subscription;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SubscriptionController extends Controller
{

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