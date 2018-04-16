<?php
/**
 * Created by PhpStorm.
 * User2: Nico
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