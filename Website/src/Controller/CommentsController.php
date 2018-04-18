<?php

namespace App\Controller;

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

    /** @Route("/event/{title}/comment") */
    public function addComment(Request $request, $title) {

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
            $commentInfo->setEventId($this->retrieveEventByTitle($title));
            $commentInfo->setReported(false);

            $this->publishComment($commentInfo);

        }

        return $this->render('form.html.twig', array('form' => $form->createView()));
    }

    public function publishComment($comment) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();
    }

    // Repeted
    public function retrieveEventByTitle($title) {
        $qb = $this->getDoctrine()->getRepository(Event::class);
        return $qb->findOneBy(['title' => $title]);
    }
}

 ?>
