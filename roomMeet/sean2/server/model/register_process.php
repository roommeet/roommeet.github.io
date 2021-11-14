<?php

//require_once 'common.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

require_once 'User.php';
require_once 'UserDAO.php';
require_once 'ConnectionManager2.php';

function doRegister($email, $name, $pwd, $password, $results) {    
    $mgr = new UserDAO();
    
    $account = $mgr->add($email, $name, $pwd);
    if ($account == True && $pwd == $password){
        $results["status"] = true;
        $results["msg"] = "Account successfully created!";
    } else {
        $results["msg"] = "Password does not match!";
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
// echo "asd";
// var_dump(json_decode( file_get_contents("php://input") ));

// $email = "sean2020";
// $name = "seantan";
// $pwd = "sean123";
// $password = "sean123";
// $results = doRegister($email, $name, $pwd, $password, $results);

if ( isset($_POST['email']) && isset($_POST['username']) && isset($_POST['pwd']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $pwd = $_POST['pwd'];
    $password = $_POST['password'];
    
    $results = doRegister($email, $name, $pwd, $password, $results);

} else { // axios sends via raw data
    $obj = json_decode( file_get_contents("php://input") );
    $email = $obj->email;
    $name = $obj->username;
    $pwd = $obj->pwd;
    $password = $obj->password;
    $results = doRegister($email, $name, $pwd, $password, $results);
}

echo json_encode( $results, JSON_PRETTY_PRINT );

