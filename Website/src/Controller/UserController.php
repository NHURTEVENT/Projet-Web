<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 11/04/2018
 * Time: 15:20
 */

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller{

    /**
     * @Route("/signin")
     */

    public function newAction()
    {
        $user = new User("moi","moi","même","moi@mail.com",0,1);
        //$user->setUsername("user".rand(1,100));

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('User created!');
    }
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

        $qb = $this->getDoctrine()->getRepository('User');
        $users = $qb->findAll();


            /*
        $queryBuilder
            ->select('id', 'name')
            ->from('users')
            ->where('email = ?')
            ->setParameter(0, $userInputEmail)
        ;*/
    }
}