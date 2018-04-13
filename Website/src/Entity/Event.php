<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 11/04/2018
 * Time: 16:42
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="events")
 */
class Event
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $title;


    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $id_user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $beginDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="boolean",options={"default":0})
     */
    private $ponctual;

    /**
     * @ORM\Column(type="boolean",options={"default":0})
     */
    private $free;


    /**
     * @ORM\Column(type="integer")
     */
    private $price;

}