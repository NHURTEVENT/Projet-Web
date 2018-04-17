<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 12/04/2018
 * Time: 13:55
 */

namespace App\Controller;


class testController
{
    /**@Route("/test")*/
    public function test(){
        return $this->render('test.html.twig', array(
            'var'=>'1'
        ));
    }
}