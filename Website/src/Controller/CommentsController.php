<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CommentForm;
use App\Entity\Comment;
use App\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentsController extends Controller {

    /** @Route("/event/{event_id}/comment") */
    public function addComment(Request $request, $event_id) {

        $session = new Session();

        $formData = new CommentForm();

        // Create Form
        $form = $this->createFormBuilder($formData)
            ->add('text', TextareaType::class, array('label' => 'Commentaire :', 'required' => true))
            ->add('save', SubmitType::class, array('label' => 'Publier'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $commentInfo = new Comment();
            $commentInfo->setText($formData->getText());
            $commentInfo->setUserId($session->get('user'));
            $commentInfo->setEventId($this->retrieveEventByTitle($event_id));
            $commentInfo->setReported(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($session->get('user'));
            $em->persist($commentInfo);
            $em->flush();

            return $this->redirect('/event/'.$event_id);
        }

        return $this->render('form.html.twig', array('form' => $form->createView()));
    }

    // Repeted
    public function retrieveEventByTitle($id) {
        $qb = $this->getDoctrine()->getRepository(Event::class);
        return $qb->findOneBy(['id' => $id]);
    }
}

 ?>
