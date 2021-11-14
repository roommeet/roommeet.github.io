<?php

require_once 'User.php';
require_once 'ConnectionManager2.php';

class UserDAO {

    public function get($email) {
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();
    
        $sql = "SELECT userid, email, name, password FROM user WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            
        $user = null;
        if ( $stmt->execute() ) {
            while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                $user = new User($row["userid"],$row["email"], $row["name"], $row["password"]);
            }
            
        }
        else {
            $connMgr->handleError( $stmt, $sql );
        }
        

        $stmt = null;
        $conn = null;        
        
        return $user;
    }


    public function add($email, $name, $password) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "INSERT INTO user
                    (
                        email, 
                        name, 
                        password                      
                    )
                VALUES
                    (
                        :email,
                        :name,
                        :password
                    )";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        //STEP 3
        $status = $stmt->execute();
        
        // STEP 4
        $stmt = null;
        $conn = null;

        // STEP 5
        return $status;
    }
}



?>