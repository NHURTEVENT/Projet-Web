<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class SignInForm {

    // TODO Remove either username OR email depending on what will be used for connection
    protected $username;
    protected $password;
    protected $email;

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
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
