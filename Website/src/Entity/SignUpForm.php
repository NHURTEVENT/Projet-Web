<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class SignUpInfo {

    /** @Assert\NotBlank(message="Ce champ est obligatoire") */
    protected $name;

    /** @Assert\NotBlank(message="Ce champ est obligatoire") */
    protected $surname;

    /** @Assert\NotBlank(message="Ce champ est obligatoire") */
    protected $username;

    /** @Assert\Length(min=5, minMessage="Doit faire plus de 5 caractères")
    *   @Assert\Regex("/[A-Z]/", message="Doit contenir une majuscule")
    *   @Assert\Regex("/[0-9]/", message="Doit contenir un chiffre")
    */
    protected $password;

    /** @Assert\NotBlank(message="Ce champ est obligatoire") */
    protected $email;

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

}

 ?>
