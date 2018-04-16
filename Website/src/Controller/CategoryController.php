<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 15/04/2018
 * Time: 20:44
 */

namespace App\Controller;


use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{

    /**
     * @Route("/category/create/{category}")
     */
    public function createCategory($category)
    {

        //search if the category doesn't exist yet
        $repo = $this->getDoctrine()->getRepository(Category::class);
        $cat = $repo->findOneBy(['category'=>$category]);

        //if if does notifies the admin
        if($cat){
            return new Response($category.' already exists');
        }
        //else creates it
        else{
            $cat = new Category();
            $cat->setCategory($category);

            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();

            return new Response('category ' . $category . 'created');
         }
    }

}