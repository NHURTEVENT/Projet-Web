<?php

namespace App\Controller;

use App\Entity\SignInForm;
use App\Entity\User;

// Required Components
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Session\Session;

// Form Components
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SignInController extends Controller {

    /** @Route("/signin") */
    public function signin(Request $request) {

        $session = new Session();
        $userData = new SignInForm();

        // Create Form
        $form = $this->createFormBuilder($userData)
            ->add('email', EmailType::class, array('label' => 'Email :'))
            ->add('password', PasswordType::class, array('label' => 'Mot de passe :'))
            ->add('save', SubmitType::class, array('label' => 'Connexion'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            // Retrieve user data from valid form
            $userData = $form->getData();

            // Check Email and Password
            $user = $this->retrieveUser($userData->getEmail(), $userData->getPassword());
            if(!is_null($user)) {

                $session->set('signin', true);
                $session->set('user', $user);

                //return $this->render('testTemplates/success.html.twig', array('msg' => 'Successfully connected to '));
                return $this->render('pageAccueil.html.twig',array());
            } else {

                $session->set('signin', false);

                return $this->render('testTemplates/status.html.twig', array('status' => 'Failure', 'msg' => 'Wrong email or password'));
            }
        }
        return $this->render('form.html.twig', array('form' => $form->createView()));
    }

    // Check if user exists with certain email AND password
    public function retrieveUser($email, $password) {

        $qb = $this->getDoctrine()->getRepository(User::class);
        return $qb->findOneBy(['email' => $email, 'password' => $password]);
    }
}
 ?>
