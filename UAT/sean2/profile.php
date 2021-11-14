<?php
    require_once("server/model/Booking.php");
    require_once("server/model/BookingDAO.php");
    require_once("server/model/Listing.php");
    require_once("server/model/ListingDAO.php");
    require_once("server/model/Review.php");
    require_once("server/model/ReviewDAO.php");
    require_once("server/model/ConnectionManager2.php");
    require_once("server/model/UserDAO.php");
    require_once("server/model/User.php");
    $bookingDAO = new BookingDAO();
    $listingDAO = new ListingDAO();
    $reviewDAO = new ReviewDAO();
    $bookings = $bookingDAO->getBookings(1);
    // print_r($reviewDAO->addReview(1, 6, 1, "very dirty room"));
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylesheets/profile.css">
    <link rel="stylesheet" href="stylesheets/main.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" 
    crossorigin="anonymous">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./stylesheets/login.css">
    <script src='https://unpkg.com/axios/dist/axios.js'></script>
    <script src="https://unpkg.com/vue@next"></script>
  
</head>
<body>
<div class="homecontainer-fluid mb-2" id=app>
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container">
                            <a href="home.php" class="navbar-brand" id="logoname">ROOMMEET.</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                                
                            <div class="collapse navbar-collapse" id="navmenu">
                                <ul class="navbar-nav ms-auto" v-if="user == null">
                                    <li class="nav-item">
                                        <a href="#login" onclick="openLoginForm()" class="nav-link">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#register" class="nav-link" onclick="openRegisterForm()" >Register</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="#browse" class="nav-link">Browse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#listings" class="nav-link">Listings</a>
                                    </li> -->
                                </ul>
                                <ul class="navbar-nav ms-auto" v-else>
                                    <li class="nav-item" style="margin:auto; padding: auto;">
                                        <b>Welcome, {{user.username}}! </b>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../JW/chatPage.php" class="nav-link">Chat</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../listing/view-listing.php" class="nav-link">Listings</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./profile.php" class="nav-link">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" onclick="logoutMsg(); doLogout();" class="nav-link">Log Out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
        <div id="window" class="window">
            <!-- REVIEW FORM -->
            <my-review></my-review>
        </div>
    
    </div>
    <div class="homecontainer-fluid mb-2">
        <row>
            <div class="header">
                <div class="hd-top">
                    
                </div>
            </div>
        </row>
    </div>
    <div class="wrapper mt-sm-5 ">
        <h4 class="pb-4 border-bottom">Account settings</h4>
        <div class="d-flex align-items-start py-3 border-bottom"> <img src="https://images.pexels.com/photos/1037995/pexels-photo-1037995.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="img" alt="">
            <div class="pl-sm-4 pl-2" id="img-section"> <b>Profile Photo</b>
                <p>Accepted file type .png. Less than 1MB</p> <button class="btn button border"><b>Upload</b></button>
            </div>
        </div>
        <?php  

            $userId = "1";
            $dao = new UserDAO();
            
            $user_object = $dao->getUser($userId); // Get a Post object
        

    



                    if($user_object){

                        // Hidden Input
                        echo "

                        
                      <form action='update.php' method='POST'>




                                <div class='fields py-2' id='fields'>

                                        <div class='row py-2'>
                                            <div class='col-md-6'> 
                                                    <label for='userId'>User ID</label> 
                                                    <input type='text' class='bg-light form-control'  name='userId' value='{$user_object->getUserid()}' >
                                            </div>
                                        </div>

                                        <div class='row py-2'>
                                            <div class='col-md-6'> 
                                                    <label for='email'>Email Address</label>
                                                     <input type='text' class='bg-light form-control' name='email' value='{$user_object->getEmail()}' >
                                             </div>
                                        </div> 

                                        <div class='row py-2'>
                                            <div class='col-md-6'> 
                                                    <label for='name'>Name</label> 
                                                    <input type='text' class='bg-light form-control' name='name' value='{$user_object->getName()}' >
                                             </div>
                                        </div>

                                        

                                        <div class='row py-2'>
                                            <div class='col-md-6'> 
                                                    <label for='password'>Password</label> 
                                                    <input type='password' class='bg-light form-control' name='password' value='{$user_object->getPassword()}' > 
                                            </div>
                                        </div> 

                                <br>
                      
                                        <div class='py-3 pb-4 border-bottom'>
                                            <button class='btn btn-primary mr-3'  type='submit'  value='Update Info' >Save Changes</button> 
                                            <button class='btn border button'>Cancel</button> 
                                        </div>
                                </div>

                        </form>

                        ";
                       
                    

                    }
            ?>
            <!-- <div class="d-sm-flex align-items-center pt-3" id="deactivate"> -->
                <h4 class="pt-4 pb-4 border-bottom">Manage Booking</h4>
                <div class="pt-2"> 
                    <table class="w-100">
                        <tr>
                            <th>Booking Details</th><th></th>
                        </tr>
                         
                          <?php
                            foreach($bookings as $booking){
                              echo "<tr>";
                              echo "<td>".$booking->getBookingDate()." : ".$listingDAO->get($booking->getListingId())->getName()."</td>";
                              if($booking->getBookingDate()>date("Y-m-d")){
                                echo "<td><button class='btn danger ml-auto'>Cancel</button></td>";
                              }else{
                                echo "<td><button class='btn success ml-auto' onclick='review()'>Leave Review</button></td>";
                              }
                            }
                          ?>  
                            
                    </table>
                </div>
                
            </div>
        </div>
    </div>
    <script src="home.js"></script>
</body>
<script>
  // function overlayOff(){
  //   document.getElementById("overlay").style.display = "none";
  // }
  function review(){
    document.getElementById("window").style.display = "block";
    document.getElementById("reviewForm").style.display = "block";
    document.getElementById("fields").style.display = "none";
  }
  function closeReview() {
    document.getElementById("window").style.display = "none";
    document.getElementById("reviewForm").style.display = "none";
    document.getElementById("fields").style.display = "block";
  } 
</script>  
</html>

