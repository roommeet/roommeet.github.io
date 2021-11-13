<?php
require_once "common.php";

class chatDAO{
    public function getAll(){
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "SELECT
                    *
                FROM chat
                ORDER BY time ASC";
        $stmt = $conn->prepare($sql);

        // STEP 3
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // STEP 4
        $chat_array = [];
        while( $row = $stmt->fetch() ) {
            $chat_array[] = 
                new chat(
                    $row['users'],
                    $row['chat_string'],
                    $row['time'],
                    $row['sender'],
                );
        }

        // STEP 5
        $stmt = null;
        $conn = null;

        // STEP 6
        return $chat_array;
    }



    public function get($users){
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "SELECT
                    *
                FROM chat
                WHERE 
                    users = :users
                ORDER BY time ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':users', $users, PDO::PARAM_STR);

        // STEP 3
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // STEP 4
        $chat_array = [];
        while( $row = $stmt->fetch() ) {
            $chat_array[] = 
                new chat(
                    $row['users'],
                    $row['chat_string'],
                    $row['time'],
                    $row['sender']
                );
        }

        // STEP 5
        $stmt = null;
        $conn = null;

        // STEP 6
        return $chat_array;
    }


    public function update($users, $chat_string, $sender){
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "INSERT INTO chat
                    (
                        users, 
                        chat_string, 
                        time, 
                        sender                        
                    )
                VALUES
                    (
                        :users,
                        :chat_string,
                        NOW(),
                        :sender
                    )";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':users', $users, PDO::PARAM_STR);
        $stmt->bindParam(':chat_string', $chat_string, PDO::PARAM_STR);
        $stmt->bindParam(':sender', $sender, PDO::PARAM_STR);

        //STEP 3
        $status = $stmt->execute();
        
        // STEP 4
        $stmt = null;
        $conn = null;

        // STEP 5
        return $status;
    }
}

    function clean_data($data){   // sanitizes inputs
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if(isset($_POST['users'])){
    // echo $_POST['users'];
    
    // echo "</br>";
    // echo $_POST['message'];
    // echo "</br>";
    // echo $_POST['sender'];
    // need to decode JSON, if you don't use JSON just pass the $_POST to clean_data()
    $users_dirty =$_POST['users'];
    $chat_string_dirty = $_POST['message'];
    $sender_dirty = $_POST['sender'];
    // echo $sender_dirty;

    // takes parameters from AJAX call and passes them to clean_data() for sanitization
    $users = clean_data($users_dirty);
    $chat_string = clean_data($chat_string_dirty);
    $sender = clean_data($sender_dirty);

    // MySQL portion
    $chatDAO = new chatDAO();
    $result = $chatDAO -> update($users, $chat_string, $sender);

    // if($result) {
    //     echo $result; // or whatever you want
    // } else {
    //     "Something went wrong.";
    // }
}


?>