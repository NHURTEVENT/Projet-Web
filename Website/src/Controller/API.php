<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 19/04/2018
 * Time: 14:56
 */

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/API")
 */
class API extends Controller
{
    /**
     * @Route("/{product_id}", name="api_get", methods="GET")
     */
    public function getProduct($product_id){
        //echo "hi".$product_id;
        $result = $this->getDoctrine()->getRepository(Product::class)->find($product_id);
        //echo "truc";

        //echo $result->getTitle();
        //var_dump($result);
        //$json = json_encode($result);
        //var_dump($json);
        $json = $result->serializeToJson();
        //var_dump($json);
        return new JsonResponse($json);
    }

    /**
     * @Route("/edit/{product_id}", name="api_post", methods="POST")
     */
    public function postProduct(Request $request, $product_id): Response
    {
        $result = $this->getDoctrine()->getRepository(Product::class)->find($product_id);

        return new Response("post");
    }

    /**
     * @Route("/new", name="api_put", methods="PUT")
     */
    public function putProduct(Request $request){
        $prod = new Product();
        $form = $this->createForm(ProductType::class,$prod);
        $form->handleRequest($request);
        return new JsonResponse($request);
        /*if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            //$em = $this->getDoctrine()->getManager();
            //$em->persist($prod);
            return new JsonResponse($prod->serializeToJson());
            $em->flush();

        }

        else {return new Response("put");}*/
    }

    /**
     * @Route("/delete/{product_id}", name="api_delete", methods="DELETE")
     */
    public function deleteProduct($product_id){
        $product = $this->getDoctrine()->getRepository(Product::class)->find($product_id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return new Response("delete");
    }

}