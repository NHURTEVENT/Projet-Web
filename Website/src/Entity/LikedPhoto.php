<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 12/04/2018
 * Time: 16:44
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="likedPhotos")
 */
class LikedPhoto
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $id_user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Photo")
     */
    private $id_photo;
}