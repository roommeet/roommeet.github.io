<?php

require_once 'Account.php';

require_once 'ConnectionManager.php';

/**
 * Quick and dirty DAO for retrieving accounts' details
 */
class AccountDAO{
    function get( $email ) {
        
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        

        $sql = "SELECT email, password FROM user WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            
        $user = null;
        if ( $stmt->execute() ) {
            while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                $user = new Account($row["email"], $row["password"]);
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

// testing
// if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
//     $mgr = new AccountMgr();

//     echo "Get Apple<br>
//     ";
//     var_dump($mgr->get('apple'));

//     echo "Get unknown<br>
//     ";
//     var_dump($mgr->get('unknown'));

// }