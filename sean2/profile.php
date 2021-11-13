<?php
    require_once("server/model/Booking.php");
    require_once("server/model/BookingDAO.php");
    require_once("server/model/Listing.php");
    require_once("server/model/ListingDAO.php");
    require_once("server/model/ConnectionManager2.php");
    $bookingDAO = new BookingDAO();
    $listingDAO = new ListingDAO();
    $bookings = $bookingDAO->getBookings(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylesheets/profile.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  
</head>
<body>
    <div id="overlay">
      <div id="text">
        
      </div>
    </div>

    <div class="wrapper mt-sm-5 ">
        <h4 class="pb-4 border-bottom">Account settings</h4>
        <div class="d-flex align-items-start py-3 border-bottom"> <img src="https://images.pexels.com/photos/1037995/pexels-photo-1037995.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="img" alt="">
            <div class="pl-sm-4 pl-2" id="img-section"> <b>Profile Photo</b>
                <p>Accepted file type .png. Less than 1MB</p> <button class="btn button border"><b>Upload</b></button>
            </div>
        </div>
        <div class="py-2">
            <div class="row py-2">
                <div class="col-md-6"> <label for="firstname">First Name</label> <input type="text" class="bg-light form-control" placeholder="Steve"> </div>
                <div class="col-md-6 pt-md-0 pt-3"> <label for="lastname">Last Name</label> <input type="text" class="bg-light form-control" placeholder="Smith"> </div>
            </div>
            <div class="row py-2">
                <div class="col-md-6"> <label for="email">Email Address</label> <input type="text" class="bg-light form-control" placeholder="steve_@email.com"> </div>
                <div class="col-md-6 pt-md-0 pt-3"> <label for="phone">Phone Number</label> <input type="tel" class="bg-light form-control" placeholder="+1 213-548-6015"> </div>
            </div>
            <div class="row py-2">
                <!-- <div class="col-md-6"> <label for="country">Country</label> <select name="country" id="country" class="bg-light">
                        <option value="india" selected>India</option>
                        <option value="usa">USA</option>
                        <option value="uk">UK</option>
                        <option value="uae">UAE</option>
                    </select> </div> -->
                <div class="col-md-6 pt-md-0 pt-3" id="lang"> <label for="language">Language</label>
                    <div class="arrow"> <select name="language" id="language" class="bg-light">
                            <option value="english" selected>English</option>
                            <option value="english_us">English (United States)</option>
                            <option value="enguk">English UK</option>
                            <option value="arab">Arabic</option>
                        </select> </div>
                </div>
            </div>
            <div class="py-3 pb-4 border-bottom"> <button class="btn btn-primary mr-3">Save Changes</button> <button class="btn border button">Cancel</button> </div>
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
</body>
<script>
  // function overlayOff(){
  //   document.getElementById("overlay").style.display = "none";
  // }
  function review(){
    document.getElementById("overlay").style.display = "block";
  }
</script>  
</html>

