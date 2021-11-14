<?php


require_once("server/model/ConnectionManager2.php");
require_once("server/model/UserDAO.php");
require_once("server/model/User.php");

$status = false;


if( isset($_POST['userId']) && isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password']) ) {
    $userId = $_POST['userId'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    $dao = new UserDAO();
    $status = $dao->update($userId, $email, $name, $password);
}


?>
<html>

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
   
<link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
<style>
    @import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
    @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
</style>
<link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>


</head>
<body>
    <?php
        if( $status ) {
       
         

            echo "
            
            <div id='demo'> </div>
            <header class='site-header' id='header'>
                <h1 class='site-header__title' data-lead-id='site-header-title'>Update was successful!</h1>
            </header>
            
        
            <div class='main-content'>
                <i class='fa fa-check main-content__checkmark' id='checkmark'></i>
            
            </div>

            <div class='main-content'>
            'Click <a href='profile.php'>here</a> to return to Main Page'
            </div>
       
            
            
            ";
        }
        else {
            echo "<h1>Update was NOT successful!</h1>";
        }
    ?>
</body>
</html>