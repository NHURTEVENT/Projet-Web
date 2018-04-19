<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class SignUpForm {

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
    private $password;

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

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }


    public function setName($name) {
        $this->name = $name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }


    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}

 ?>
