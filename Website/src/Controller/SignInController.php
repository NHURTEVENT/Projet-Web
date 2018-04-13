<?php

namespace App\Controller;

use App\Entity\SignInForm;

// Required Components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Validator\ValidatorInterface;

// Form Components
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SignInController extends Controller {

    /** @Route("/signin") */
    public function new(Request $request) {

        $userData = new signInForm();

        $form = $this->createFormBuilder($userData)
            ->add('email', EmailType::class, array('label' => 'Email :'))
            ->add('password', PasswordType::class, array('label' => 'Mot de passe : '))
            ->add('save', SubmitType::class, array('label' => 'Inscription'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()) {

            $userData = $form->getData();       // Retrieve user data from valid form
            // Check BDD for that email & password
            // Create environement variables
            // Redirect to home page
            echo "Submitted";

        }

        return $this->render('form.html.twig', array('form' => $form->createView()));
    }

}
 ?>
