<?php
/**
 * Created by PhpStorm.
 * User: Pierre Mazurier
 * Date: 19/04/2018
 * Time: 21:58
 */

namespace App\Entity;


class PhotoForm
{

    private $image;
    private $description;

    public function getDescription() {
        return $this->description;
    }

    public function getImage() {
        return $this->image;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setImage($email) {
        $this->image = $email;
    }

}