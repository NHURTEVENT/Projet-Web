<?php

namespace App\Controller;

use App\Entity\SignUpForm;
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


class SignUpController extends Controller {

    /** @Route("/signup") */
    public function signup(Request $request) {

        $session = new Session();

        $userData = new SignUpForm();

        // Create Form
        $form = $this->createFormBuilder($userData)
            ->add('name', TextType::class, array('label' => 'Prenom :'))
            ->add('surname', TextType::class, array('label' => 'Nom :'))
            ->add('username', TextType::class, array('label' => "Nom d'Utilisateur : "))
            ->add('email', EmailType::class, array('label' => 'Email :'))
            ->add('password', RepeatedType::class, array('type' => PasswordType::class, 'invalid_message' => 'Les mots de passes doivent être identiques', 'first_options' => array('label' => 'Mot de passe'), 'second_options' => array('label' => 'Reécrire le mot de passe')))
            ->add('save', SubmitType::class, array('label' => 'Inscription'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            // Retrieve user data from valid form
            $userData = $form->getData();

            // Make sure username & email are unique
            if($this->paramUsed('username', $userData->getUsername()) || $this->paramUsed('email', $userData->getEmail())) {

                // Set environement variable
                $session->set('signup', false);

                // Redirect
                //return $this->redirectToRoute('/signup');
                return $this->render('testTemplates/failure.html.twig', array('msg' => 'Username or email already taken'));

            } else {

                // Create new user
                $user = new User();

                $user->setUsername($userData->getUsername());
                $user->setName($userData->getName());
                $user->setSurname($userData->getSurname());
                $user->setEmail($userData->getEmail());
                $user->setPassword($userData->getPassword());
                $user->setAdmin(0);
                $user->setModo(0);

                // Add user to BDD
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // Set environement variable
                $session->set('signup', true);

                // Redirect to home page
                //return $this->redirectToRoute('home');
                return $this->render('testTemplates/success.html.twig', array('msg' => 'Successfully created new user'));
            }
        }
        return $this->render('form.html.twig', array('form' => $form->createView()));
    }

    // Check if certain parameter is already used by a user
    public function paramUsed($paramName, $param) {

        $qb = $this->getDoctrine()->getRepository(User::class);
        $user = $qb->findOneBy([$paramName => $param]);

        if(is_null($user)) {
            return 0;
        } else {
            return 1;
        }
    }
}
 ?>
