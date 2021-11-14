<?php

//require_once 'common.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

require_once 'User.php';
require_once 'UserDAO.php';
require_once 'ConnectionManager.php';

function doLogin($email, $pwd, $results) {    
    $mgr = new UserDAO();
    
    $account = $mgr->get($email);
    if ( $account != null && $account->getPassword() == $pwd){
        $results["userid"] = $account->getUserid();
        $results["status"] = true;
        $results["name"] = $account->getName();
    }
    return $results;
}

$results = [
    "status" =>  false
];


// $obj = json_decode( file_get_contents("php://input") );
// var_dump($obj);
// $email = $obj->email;
// $pwd = $obj->pwd;


if ( isset($_POST['email']) && isset($_POST['pwd'])) {
    $emailid = $_POST['email'];
    $pwd = $_POST['pwd'];
    
    $results = doLogin($emailid, $pwd, $results);

} else { // axios sends via raw data
    $obj = json_decode( file_get_contents("php://input") );
    $email = $obj->email;
    $pwd = $obj->pwd;
    $results = doLogin($email, $pwd, $results);
}

echo json_encode( $results, JSON_PRETTY_PRINT );

