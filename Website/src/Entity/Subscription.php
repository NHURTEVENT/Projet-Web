<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 11/04/2018
 * Time: 21:13
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subscriptions")
 */
class Subscription
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $id_user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Event")
     */
    private $id_event;
}