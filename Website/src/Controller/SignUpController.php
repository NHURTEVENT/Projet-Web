<?php

namespace App\Controller;

use App\Entity\SignUpForm;

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


class SignUpController extends Controller {

    /** @Route("/signup") */
    public function new(Request $request) {

        $userData = new signUpForm();

        $form = $this->createFormBuilder($userData)
            ->add('email', EmailType::class, array('label' => 'Email :'))
            ->add('username', TextType::class, array('label' => "Nom d'Utilisateur : "))
            ->add('password', RepeatedType::class, array('type' => PasswordType::class, 'invalid_message' => 'Les mots de passes doivent être identiques', 'first_options' => array('label' => 'Mot de passe'), 'second_options' => array('label' => 'Reécrire le mot de passe')))
            ->add('save', SubmitType::class, array('label' => 'Inscription'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $userData = $form->getData();       // Retrieve user data from valid form
            // Add to BDD
            // Create environement variables
            // Redirect to home page
            echo "Submitted & Valid";
        }

        return $this->render('form.html.twig', array('form' => $form->createView()));
    }

}
 ?>
