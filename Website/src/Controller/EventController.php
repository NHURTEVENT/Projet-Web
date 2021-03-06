<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 12/04/2018
 * Time: 13:55
 */

namespace App\Controller;

use App\Entity\EventForm;
use App\Entity\Comment;
use App\Entity\Event;

// Required Components
use App\Entity\LikedEvent;
use App\Entity\Photo;
use App\Entity\PhotoForm;
use App\Repository\EventRepository;
use App\Repository\LikedEventRepository;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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

        $session = new Session();

        // Retrieve data from DB
        $events = $this->retrieveAllEvents();


        // Render everything
        return $this->render('events.html.twig', array(
            'events' => $events,
            'user' => $session->get('user')
        ));
    }

    /** @Route("/event/{event_id}") */
    public function viewEvent($event_id, Request $request) {

        $session = new Session();
        $event = $this->retrieveEventById($event_id);
        $photos = $this->retrieveAllPhotos();

        /* AJAX REQUEST MANAGEMENT
        if ($request->isXmlHttpRequest()) {

            $content = $request->getContent();

            if($content == 'like') {

               // Create a new LikedEvent
               $likedEvent = new LikedEvent();
               $likedEvent->setUserId($session->get('user'));
               $likedEvent->setEventId($event);

               // Add to DB
               //$em = $this->getDoctrine()->getManager();
               //$em->persist($likedEvent);
               //$em->flush();

               return new Response('LIKE_SUCCESS', 200);

           } else if($content == 'report') {

               return new Response('REPORT_SUCCESS', 200);

           } else if($content == 'subscribe') {

               return new Response('SUBSCRIBE_SUCCESS', 200);

           } else {
               return new Response('Bad Request', 400);
           }
        }
        */

        return $this->render('event.html.twig', array(
            'event' => $event,
            'comments' => $this->getAllComments($event),
            'user' => $session->get('user'),
            'photos' => $photos
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

        $formData = new EventForm();

        // Create Form
        $form = $this->createFormBuilder($formData)
            ->add('title', TextType::class, array('label' => 'Titre :'))
            ->add('description', TextareaType::class, array('label' => 'Description :', 'required' => false))
            ->add('begin_date', DateType::class, array('label' => 'Date de début :', 'data' => new \DateTime()))
            ->add('end_date', DateType::class, array('label' => 'Date de fin :', 'data' => new \DateTime()))
            ->add('ponctual', CheckboxType::class, array('label' => 'Ponctuel :', 'required' => false))
            ->add('free', CheckboxType::class, array('label' => 'Gratuit :', 'required' => false))
            ->add('price', MoneyType::class, array('label' => 'Prix ', 'data' => 0, 'required' => false))
            //->add('image', FileType::class, array('label' => 'Image'))
            ->add('save', SubmitType::class, array('label' => 'Publier'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $event = new Event();
            $event->setTitle($formData->getTitle());
            $event->setDescription($formData->getDescription());
            $event->setBeginDate($formData->getBeginDate());
            $event->setEndDate($formData->getEndDate());
            $event->setPonctual($formData->isPonctual());
            $event->setFree($formData->isFree());
            $event->setPrice($formData->getPrice());
            $event->setReported(false);
            // TODO ADD USER ID

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->render('testTemplates/status.html.twig', array('status' => 'Success', 'msg' => 'Yay!'));
        }

        return $this->render('form.html.twig', array('form' => $form->createView()));

    }


    /**
     * @Route("/event/{event_id}/addphoto")
     */
    public function addPhoto(Request $request, $event_id)
    {

        $formData = new PhotoForm();

        // Create Form
        $form = $this->createFormBuilder($formData)
            ->add('description', TextareaType::class, array('label' => 'Description :'))
            ->add('image', FileType::class, array('label' => 'Image'))
            ->add('save', SubmitType::class, array('label' => 'Publier'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $session = new Session();
            $user = $session->get('user');

            $photo = new Photo();
            $photo->setDescription($formData->getDescription());
            $photo->setUrl($formData->getImage());
            $photo->setReported(false);
            $photo->setEventId($this->retrieveEventById($event_id));
            $photo->setUserId($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->persist($photo);
            $em->flush();

            return $this->redirect('/home');
        }

        return $this->render('form.html.twig', array('form' => $form->createView()));
    }

    public function like($event) {

        $session = new Session();

        if(NULL !== $session->get('user')) {





        } else {
            // User is NOT connected
        }

    }

    /**
     * @Route("/event/{event_id}/report")
     */
    public function reportEvent($event_id) {

        $repo = $this->getDoctrine()->getRepository(Event::class);
        $repo->reportEvent($this->retrieveEventById($event_id));

        return $this->redirect('/event/'.$event_id);
    }

    public function addEventToDB($event) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();
    }

    public function retrieveEventById($event_id) {
        $qb = $this->getDoctrine()->getRepository(Event::class);
        return $qb->find($event_id);
    }

    public function retrieveAllEvents() {
        $qb = $this->getDoctrine()->getRepository(Event::class);
        return $qb->findAll();
    }

    public function retrieveAllPhotos() {
        $qb = $this->getDoctrine()->getRepository(Photo::class);
        return $qb->findAll();
    }

    public function getAllComments($id_event) {
        $qb = $this->getDoctrine()->getRepository(Comment::class);
        return $qb->findBy(['event_id' => $id_event]);
    }

}
