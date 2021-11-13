<?php
header("Access-Control-Allow-Origin: *");

require_once 'model/AccountMgr.php';

function doLogin($userid, $pwd, $results) {    
    $mgr = new AccountMgr();
    
    $account = $mgr->get($userid);
    if ( $account != null && $account->getPassword() == $pwd){
        $results["status"] = true;
        $results["userid"] = $userid ;
        $results["name"] = $account->getName();
    }
    return $results;
}

$results = [
    "status" =>  false
];

if ( isset($_POST['userid']) && isset($_POST['pwd'])) {
    $userid = $_POST['userid'];
    $pwd = $_POST['pwd'];
    
    $results = doLogin($userid, $pwd, $results);

} else { // axios sends via raw data
    $obj = json_decode( file_get_contents("php://input") );
    $userid = $obj->userid;
    $pwd = $obj->pwd;
    $results = doLogin($userid, $pwd, $results);
}

echo json_encode( $results, JSON_PRETTY_PRINT );