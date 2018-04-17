<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 12/04/2018
 * Time: 13:55
 */

namespace App\Controller;

use App\Entity\EventFormInfo;
use App\Entity\Comment;
use App\Entity\Event;

// Required Components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\DateTime;

// Form Components
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventController extends Controller {



    /** @Route("/home") */
    public function viewAllEvents() {

        // Retrieve data from DB
        $events = $this->retrieveAllEvents();

        // Render everything
        return $this->render('events.html.twig', array(
            'events' => $events
        ));
    }


    /** @Route("/event/{title}") */
    public function viewEvent($title) {

        $event = $this->retrieveEventByTitle($title);
        return $this->render('event.html.twig', array(
            'event' => $event,
            'comments' => $this->getAllComments($event->getId())
        ));
    }

    /**
     * @Route("/eventofthemonth")
     */
    public function eventOfTheMonth(){
        $repo = $this->getDoctrine()->getRepository(Event::class);
        $events = $repo->eventOfTheMonth();

        foreach ($events as $event){
            echo $event->getTitle().", ";
        }

        return new Response('are the events this month');

    }


    /** @Route("/events/add") */
    public function addEvent(Request $request) {

        $formData = new EventFormInfo();

        // Create Form
        $form = $this->createFormBuilder($formData)
            ->add('title', TextType::class, array('label' => 'Titre :'))
            ->add('description', TextareaType::class, array('label' => 'Description :', 'required' => false))
            ->add('begin_date', DateType::class, array('label' => 'Date de début :', 'data' => new \DateTime()))
            ->add('end_date', DateType::class, array('label' => 'Date de fin :', 'data' => new \DateTime()))
            ->add('ponctual', CheckboxType::class, array('label' => 'Ponctuel :', 'required' => false))
            ->add('free', CheckboxType::class, array('label' => 'Gratuit :', 'required' => false))
            ->add('price', MoneyType::class, array('label' => 'Prix ', 'data' => 0, 'required' => false))
            ->add('save', SubmitType::class, array('label' => 'Publier'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $event = new Event(
                $formData->getTitle(),
                $formData->getDescription(),
                $formData->getBeginDate(),
                $formData->getEndDate(),
                $formData->isPonctual(),
                $formData->isFree(),
                $formData->getPrice()
                // TODO USER ID
            );

            $this->addEventToDB($event);

            return $this->render('testTemplates/success.html.twig', array('msg' => '...'));
        }

        return $this->render('form.html.twig', array('form' => $form->createView()));

    }

    public function like($event_id) {

        $session = new Session();

        LikedEventController::like($session->get('user_id'), $event_id);

    }

    public function addEventToDB($event) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();
    }

    public function retrieveEventByTitle($title) {
        $qb = $this->getDoctrine()->getRepository(Event::class);
        return $qb->findOneBy(['title' => $title]);
    }

    public function retrieveAllEvents() {
        $qb = $this->getDoctrine()->getRepository(Event::class);
        return $qb->findAll();
    }

    public function getAllComments($id_event) {
        $qb = $this->getDoctrine()->getRepository(Comment::class);
        return $qb->findBy(['id_event' => $id_event]);
    }

}
