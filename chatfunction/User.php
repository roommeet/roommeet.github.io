<?php

class User {
    private $userId;
    private $email;
    private $name;
    private $password;
    //constructor
    public function __construct($userId, $email, $name, $password) {
        $this->userId = $userId;
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }
    //getters
    public function getUserId() {
        return $this->userId;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }

    //setters
    public function setEmail() {
        $this->email = $email;
    }

    public function setName() {
        $this->name = $name;
    }

    public function setPassword() {
        $this->password = $password;
    }


    public function __toString() {
        return json_encode( [ 
            'email' => $this->email,
    
            'name' => $this->name,
    
            'password' => $this->password,
            ] );
        }
}



?>