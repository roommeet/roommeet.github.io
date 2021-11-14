<?php

class User {
    private $userid;
    private $email;
    private $name;
    private $password;
    //constructor
    public function __construct($userid, $email, $name, $password) {
        $this->userid = $userid;
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }
    //getters
    public function getUserid() {
        return $this->userid;
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