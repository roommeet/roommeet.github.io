<?php

require_once 'User.php';
require_once 'ConnectionManager2.php';

class UserDAO {

    public function getAll() {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "SELECT
                    *
                FROM user"; // SELECT * FROM post; // This will also work
        $stmt = $conn->prepare($sql);

        // STEP 3
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // STEP 4
        $bookings = []; // Indexed Array of Post objects
        while( $row = $stmt->fetch() ) {
            $users[] =
                new User(
                    $row['userId'],
                    $row['email'],
                    $row['name'],
                    $row['password']
                );
        }

        // STEP 5
        $stmt = null;
        $conn = null;

        // STEP 6
        return $users;
    }

    public function get($email) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "SELECT
                    *
                FROM user
                WHERE 
                email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // STEP 3
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // STEP 4
        $user_object = null;
        if( $row = $stmt->fetch() ) {
            $user_object = 
                new User(
                    $row['userId'],
                    $row['email'],
                    $row['name'],
                    $row['password']
                );
        }

        // STEP 5
        $stmt = null;
        $conn = null;

        // STEP 6
        return $user_object;
    }

    public function getUser($userId) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "SELECT
                    *
                FROM user
                WHERE 
                userId = :userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        // STEP 3
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // STEP 4
        $user_object = null;
        if( $row = $stmt->fetch() ) {
            $user_object = 
                new User(
                    $row['userId'],
                    $row['email'],
                    $row['name'],
                    $row['password']
                );
        }

        // STEP 5
        $stmt = null;
        $conn = null;

        // STEP 6
        return $user_object;
    }

    public function update($userId, $email, $name, $password){
        $connMgr = new ConnectionManager();
            $conn = $connMgr->connect();
   
            $sql = "UPDATE 
                        user 
                    SET 
                        userId = :userId, 
                        email = :email,
                        name = :name,
                        password = :password
                    WHERE 
                        userId=:userId";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
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