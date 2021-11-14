<?php

require_once 'User.php';
require_once 'ConnectionManager.php';

class UserDAO {
    function get($email) {
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();
        

        $sql = "SELECT userId, email, name, password FROM user WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            
        $user = null;
        if ( $stmt->execute() ) {
            while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                $user = new User($row["userId"],$row["email"], $row["name"], $row["password"]);
            }
            
        }
        else {
            $connMgr->handleError( $stmt, $sql );
        }
        

        $stmt = null;
        $conn = null;        
        
        return $user;
    }

    function getWithId($userId){
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();
        

        $sql = "SELECT * FROM user WHERE userId = :userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":userId", $userId, PDO::PARAM_STR);
            
        $user = null;
        if ( $stmt->execute() ) {
            while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                $user = new User($row["userId"],$row["email"], $row["name"], $row["password"]);
            }
            
        }
        else {
            $connMgr->handleError( $stmt, $sql );
        }
        

        $stmt = null;
        $conn = null;        
        
        return $user;
    }

}



?>