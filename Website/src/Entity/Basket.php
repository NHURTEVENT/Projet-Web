<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 11/04/2018
 * Time: 21:12
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="baskets")
 */
class Basket
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $id_user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Product")
     */
    private $id_product;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $quantity;


}