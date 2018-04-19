<?php

namespace App\Controller;

use App\Entity\LikedEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;

class LikedEventController extends Controller {

    /**
     * @Route("/event/{event_id}/like")
     */
    public function like($event_id) {

        $session = new Session();
        $user = $session->get('user');

        $likedEvent = new LikedEvent();
        $likedEvent->setUserId($user);
        $likedEvent->setEventId($this->retrieveEventById($event_id));

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->persist($likedEvent);
        $em->flush();

        return $this->redirect('/event/'.$event_id);
    }

    public function retrieveEventById($event_id) {
        $qb = $this->getDoctrine()->getRepository(Event::class);
        return $qb->find($event_id);
    }
}

 ?>
