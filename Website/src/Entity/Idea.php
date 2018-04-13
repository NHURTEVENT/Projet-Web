<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 11/04/2018
 * Time: 21:11
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ideas")
 */
class Idea
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id_idea;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $upvotes;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $id_creator;


}