<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class SignInInfo {

    // TODO Remove either username OR email depending on what will be used for connection
    protected $email;
    protected $password;

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

}

 ?>
