<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="user_index", methods="GET")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', ['users' => $userRepository->findAll()]);
    }

    /**
     * @Route("/new", name="user_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods="GET")
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods="GET|POST")
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', ['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods="DELETE")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }






    /**
     * @Route("/user/create/{username}/{name}/{surname}/{mail}/{password}")
     */
    public function createUser($username, $name, $surname, $mail, $password)
    {
        $user = new User();
        $user->setUsername($username);
        $user->setName($name);
        $user->setSurname($surname);
        $user->setEmail($mail);
        $user->setPassword($password);
        $user->setAdmin(0);
        $user->setModo(0);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('User '.$username.' created!');
    }





// TO REMOVE

    /**
     * @Route("/users/{username}")
     */
    public function showAction($username)
    {


        return new Response(''.$username);
    }

    /**
     * @Route("/login/{username}/{password}")
     */
    public function checkUser($username, $password){

        $repo = $this->getDoctrine()->getRepository(User2::class);
        //$user = $qb->find($username);
        $user = $repo->findOneBy(['username'=>$username]);

        if (!$user) {
            return new Response('No user found for username '.$username);
        }

        /*
    $queryBuilder
        ->select('id', 'name')
        ->from('users')
        ->where('email = ?')
        ->setParameter(0, $userInputEmail)
    ;*/

        else {

            $password = $repo->findOneBy(['password'=>$password]);

            if(!$password){
                return new Response('Invalid password');
            }
            else{
                return new Response("hi ".$user->getName().' '.$user->getSurname());
            }
        }
    }

    public function isUsernameAvailable($username){
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->findOneBy(['username'=>$username]);

        if (!$user) {
            return true;
        }
        else{
            return false;
        }

    }

}
