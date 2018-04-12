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
 * @ORM\Table(name="photos")
 */
class Photo
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id_photo;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="boolean",options={"default":0})
     */
    private $reported;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $id_user;

    /**
     * @ORM\ManyToOne(targetEntity="Event")
     */
    private $id_event;


}