<?php

//require_once 'common.php';


header("Access-Control-Allow-Origin: *");

require_once 'Account.php';
require_once 'AccountMgr.php';
require_once 'ConnectionManager.php';


    $errors = [];


    $username = $_POST["email"];
    $password = $_POST["password"];
    var_dump($username);
    var_dump($password);
    // $username = "apple2020";
    // $password = "apple123";


    $dao = new AccountDAO();
    $user = $dao->get( $username );

    if ($user)
    {

        $hashed_password = $user->getPassword();

        //$status = password_verify( $password, $hashed_password); 

        if ($hashed_password == $password)
        { 
            // $_SESSION["username"] = $username;
            // header("Location: ../index.php");
            // return;
            echo "hi";
        }
        else
        {

            // $errors [] = "Invalid password.";
            // $_SESSION['errors'] = $errors;
            // $_SESSION["login_page"] = $username;
            // header("Location: loginpage.php");
            // return;
            echo "no";

        }

    } else
    {
        // $errors [] = "Username does not exist in the database.";
        // $_SESSION['errors'] = $errors;
        // $_SESSION["login_page"] = $username;
        // header("Location: loginpage.php");
        // return;
            echo "none";
    }

    ?>