<?php

class Account {
   // properties
   
   private $userid;
   private $name;
   private $password;

   // constructor
   
   public function __construct($userid, $password) {
      
      $this->userid = $userid;
     // $this->name = $name;
      $this->password = $password;
   }


   // getters
   
   public function getUserid() {
      return $this->userid;
   }

   public function getName() {
      return $this->name;
   }

   public function getPassword() {
      return $this->password;
   }


   // setters
   
   public function setUserid($userid) {
      $this->userid = $userid;
   }

   public function setName($name) {
      $this->name = $name;
   }

   public function setPassword($password) {
      $this->password = $password;
   }


   // magic methods
   
   public function __toString() {
      return json_encode( [ 
            
         'userid' => $this->userid,

         'name' => $this->name,

         'password' => $this->password,
 
         ] );
   }

} // end class Account