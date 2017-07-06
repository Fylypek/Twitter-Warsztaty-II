<?php

class User {
    private $id;
    private $userName;
    private $password;
    private $email;
}

public function __construct() {
    $this->id = -1;
    $this->userName = "";
    $this->password = "";
    $this->email = "";
}



