<?php
    require_once('common.php');
    require_once('server/helper/reviewFunctions.php');

    session_start();
    $_SESSION["listingId"]="";
    $_SESSION["userId"]="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="icon" href="favicon.ico">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src='https://unpkg.com/axios/dist/axios.js'></script>
    <script src="https://unpkg.com/vue@next"></script>
    <script>
    </script>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size:14px;
            color: black;
            background: url("img/bg.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .header{
            display: block;
        }
        .hd-top{
            display: block;
            overflow: auto;
            padding-bottom: 10px;
        }
        .logo{
            float:left;
        }
        .hd-search{
            float: left;
            margin-left: 30px;
            font-size:x-small;
        }
        .hd-search-bar{
            float: right;
            margin-left: 60px;
            margin-top: 30px;
            width: 30%;
        }
        .hd-search-bar input[type=text]{
            float: left;
            width: 90%;
        }
        .hd-top-nav{
            display: block;
            width: 100%;
        }
        .hd-top-nav a{
            margin-right: 10px;
        }
        .float-right{
            float: right;
        }
        .room-type a{
            margin-right: 10px;
            text-decoration: none;
        }
        
        .card-img-top{
            width: 550px;
            height: 480px;
        }
        .card{
            margin-bottom: 10px;
            letter-spacing: 2px;
        }
        label {
            width:100px;
            clear:left;
            text-align:left;
            /* padding-right:10px; */
        }

        input, label {
            float:left;
        }
        .heading {
        font-size: 25px;
        margin-right: 25px;
        }

        .fa {
        font-size: 25px;
        }

        .checked {
        color: orange;
        }

        /* Three column layout */
        .side {
        float: left;
        width: 15%;
        margin-top: 10px;
        }

        .middle {
        float: left;
        width: 70%;
        margin-top: 10px;
        }

        /* Place text to the right */
        .right {
        text-align: right;
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }

        /* The bar container */
        .bar-container {
        width: 100%;
        background-color: #f1f1f1;
        text-align: center;
        color: white;
        }

        /* Individual bars */
        #bar-5 {width: 60%; height: 18px; background-color: #04AA6D;}
        #bar-4 {width: 30%; height: 18px; background-color: #2196F3;}
        #bar-3 {width: 10%; height: 18px; background-color: #00bcd4;}
        #bar-2 {width: 4%; height: 18px; background-color: #ff9800;}
        #bar-1 {width: 15%; height: 18px; background-color: #f44336;}

        .main-content{
            box-shadow: 3px 3px 5px 1px grey;
        }

        .card-body{
            box-shadow: 3px 3px 5px 1px grey;
        }

        /* Responsive layout - make the columns stack on top of each other instead of next to each other */
        @media (max-width: 400px) {
        .side, .middle {
            width: 100%;
        }
        /* Hide the right column on small screens */
        .right {
            display: none;
        }
        }
    </style>
    <link rel="stylesheet" href="css/main.css">
    <title>View Details</title>
</head>
<body> 
<div class="homecontainer-fluid mb-2" id="app">
        <row>
            <div class="header">
                <div class="hd-top">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container">
                            <a href="../sean2/home.php" class="navbar-brand" id="logoname">ROOMMEET.</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                                
                            <div class="collapse navbar-collapse" id="navmenu">
                                <ul class="navbar-nav ms-auto" v-if="user == null">
                                    <li class="nav-item">
                                        <a href="../sean2/home.php" onclick="openLoginForm()" class="nav-link">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#register" class="nav-link" onclick="openRegisterForm()" >Register</a>
                                    </li>
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
                </div>
            </div>
        </row>
    </div>

    <?php
        $listingId = $_POST['listingId'];
        $_SESSION["listingId"] =$listingId;
        $listingDAO = new ListingDAO();
        $listing_obj = $listingDAO->get($listingId);
    ?>
    
    <div class="container main-content" style="background-color: rgb(255,255,255,0.7);">
        <div class="row justify-content-center">
            <div class="col-sm-6 my-3">
                <h2 class="card-title" style="letter-spacing: 5px;"><strong><?php echo $listing_obj->getName(); ?></strong></h2>
            </div>
        </div>    
        <div class="row ">
            <div class="col-sm-12 text-center">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-sm-4 m-0 p-0">
                                    <img src="<?php echo $listing_obj->getUrl(); ?>" class="d-block w-100" alt="...">
                                </div>
                                <div class="col-sm-4 m-0 p-0">
                                    <img src="<?php echo $listing_obj->getUrl(); ?>" class="d-block w-100" alt="...">
                                </div>
                                <div class="col-sm-4 m-0 p-0">
                                    <img src="<?php echo $listing_obj->getUrl(); ?>" class="d-block w-100" alt="...">   
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-sm-4 m-0 p-0">
                                    <img src="<?php echo $listing_obj->getUrl(); ?>" class="d-block w-100" alt="...">
                                </div>
                                <div class="col-sm-4 m-0 p-0">
                                    <img src="<?php echo $listing_obj->getUrl(); ?>" class="d-block w-100" alt="...">
                                </div>
                                <div class="col-sm-4 m-0 p-0">
                                    <img src="<?php echo $listing_obj->getUrl(); ?>" class="d-block w-100" alt="...">   
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-sm-6 my-2">
                <div class="card border border-white">
                    <div class="card-body">
                        <?php
                            $availability = $listing_obj->getBooked();
                            if($availability=="No"){
                                echo '<h6 class="card-title float-right text-primary">Available for Booking</h6>';
                            }else if($availability=="Fully"){
                                echo '<h6 class="card-title float-right text-danger">Currently not Available</h6>';
                            }else if($availability=="halfAm"){
                                echo '<h6 class="card-title float-right text-info">Available after 3pm Today</h6>';
                            }else if($availability=="halfPm"){
                                echo '<h6 class="card-title float-right text-info">Available before 3pm Today</h6>';
                            }
                        ?>
                        <h5 class="card-title"><strong>S$<?php echo $listing_obj->getPrice(); ?> / day</strong></h5>
                        <h5 class="card-text"><?php echo $listing_obj->getBedRooms(); ?> Bedrooms <?php echo $listing_obj->getBathRooms(); ?> Bathrooms<?php echo $listing_obj->getSize(); ?> sqft</h5>
                        <h5 class="card-title"><?php echo $listing_obj->getAddress(); ?></h5>
                        <br>
                        <br>
                        <div class="review">
                            <span class="heading">User Rating</span>
                            <?php
                                printStars($listing_obj->getID());
                            ?>
                            <p><?php echo calculateAvg($listing_obj->getID())?> average based on <?php echo getSize($listing_obj->getID())?> reviews.</p>
                            <hr style="border:3px solid #f1f1f1">
                            
                            <div class="row">
                                <div class="side">
                                <div>5 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div id="bar-5"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div><?php echo countEach($listing_obj->getID())["5"]?></div>
                                </div>
                                <div class="side">
                                    <div>4 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div id="bar-4"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div><?php echo countEach($listing_obj->getID())["4"]?></div>
                                </div>
                                <div class="side">
                                    <div>3 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div id="bar-3"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div><?php echo countEach($listing_obj->getID())["3"]?></div>
                                </div>
                                <div class="side">
                                    <div>2 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div id="bar-2"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div><?php echo countEach($listing_obj->getID())["2"]?></div>
                                </div>
                                <div class="side">
                                    <div>1 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div id="bar-1"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div><?php echo countEach($listing_obj->getID())["1"]?></div>
                                </div>
                            </div>
                        </div>

                        <div class="btn-wrapper text-center my-3">
                            <a href="#" class="btn btn-primary my-3" onclick="booking()">Make Booking Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="payment.php" method="post">
    <div id="hidden-form" class="container bg-light main-content " style="opacity: 0.8">
        <div class="row justify-content-center m-4 p-3">
        
            <div class="col-sm-3">
                <h3 class="mb-4"><strong>Booking Details</strong></h3>
                <div class="booking-date m-2">
                    <label for="start">Select date:</label>
                    <input type="date" id="booking_start" name="booking_start" value="<?php echo date("Y-m-d")?>" min="2021-10-31" max="2021-12-31" onchange="getDate()">
                </div>
                <br>
                <div class="booking-option m-2">
                    <label for="start">Booking option:</label>
                    <select id="bookingOption" name="bookingOption" onchange="calculatePrice()">
                        <option selected value="full">Full day</option>
                        <option value="halfAm">8pm ~ 3pm</option>
                        <option value="halfPm">3pm ~ 10pm</option>
                    </select>
                </div>
                <br>
                <div id="hidden-booking-details" class="m-2">
                    <?php
                            if($availability=="No"){
                                echo "<p class='text-success'><strong>Available for all day!</strong></p>";
                            }else if($availability=="Fully"){
                                echo "<p class='text-danger'><strong>Not Available for the given date!</strong></p>";
                            }else if($availability=="halfAm"){
                                echo "<p class='text-success'><strong>Available from 3pm!</strong></p>";
                            }else if($availability=="halfPm"){
                                echo "<p class='text-success'><strong>Available before 3pm!</strong></p>";
                            }
                        ?>
                </div>
                <div class="booking-option m-2">
                    
                    <br>
                    <hr>
                    <h4 class="float-right">Estimated Price: <strong id="checkout" class="text-muted">$<?php echo $listing_obj->getPrice();?></strong></h4>
                    <input type="hidden" id="pass_price" name="pass_price" value="<?php echo $listing_obj->getPrice();?>">
                </div>
            </div>
            <div class="col-sm-3">
                <h3><strong>Contact Details</strong></h3>
                <div class="contact-first-name m-2">
                    <label for="start">First Name:</label>
                    <input type="text" id="fname" name="fname"><br>
                </div>
                <div class="contact-last-name m-2">
                    <label for="start">Last Name:</label>
                    <input type="text" id="lname" name="lname"><br>
                </div>
                <div class="contact-email m-2">
                    <label for="start">Email:</label>
                    <input type="email" id="email" name="email"><br>
                </div>
                <div class="contact-mobile m-2">
                    <label for="start">Mobile Number:</label>
                    <input type="text" id="mobile" name="mobile"><br>
                </div>
            </div>

        </div>
        <div class="btn-wrapper text-center my-3">
            <button type="submit" id="btn-payment" class="btn btn-primary my-3" disable="">Make Payment</button>
        </div>
        </form>
    </div>

    <script>
        document.getElementById("bar-1").style.width = "<?php echo (intval(countEach(1)["1"])/getSize(1)*100); ?>%";
        document.getElementById("bar-2").style.width = "<?php echo (intval(countEach(1)["2"])/getSize(1)*100); ?>%";
        document.getElementById("bar-3").style.width = "<?php echo (intval(countEach(1)["3"])/getSize(1)*100); ?>%";
        document.getElementById("bar-4").style.width = "<?php echo (intval(countEach(1)["4"])/getSize(1)*100); ?>%";
        document.getElementById("bar-5").style.width = "<?php echo (intval(countEach(1)["5"])/getSize(1)*100); ?>%";
        document.getElementById("hidden-form").style.display="none";         
        
        var bookingOption = document.getElementById("bookingOption");
        var hidden_form = document.getElementById("hidden-booking-details");

        var checkoutPrice = "<?php echo $listing_obj->getPrice()?>";   
        var listingId = "<?php echo $listing_obj->getID()?>";  
        var bookingStartDate = document.getElementById("booking_start");
        

        function booking(){
            const form = document.getElementById("hidden-form");
            form.style.display="block";
        }
        $('input[type="checkbox"]').on('change', function() {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });

        document.getElementById("btn-payment").addEventListener("click", function(event){
            if(hidden_form.innerText=="Not Available for the given date!"){
                event.preventDefault();
                // alert("You cannot make a booking on a given date!");
                document.getElementById("btn-payment").disable = "disabled";

            }
        });
        function calculatePrice(){
            var hidden_price = document.getElementById("pass_price");
            const price = document.getElementById("checkout");
            if(bookingOption.value=="halfAm"||bookingOption.value=="halfPm"){
                price.innerHTML="$"+checkoutPrice/2;
                hidden_price.value = checkoutPrice/2;
            }else{
                price.innerHTML="$"+checkoutPrice;
                hidden_price.value = checkoutPrice;
            }
        }

        function getDate(){
            console.log(bookingStartDate.value);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    hidden_form.innerHTML = this.responseText;
                    if(hidden_form.innerText=="Not Available for the given date!"){
                        document.getElementById("btn-payment").classList.add("btn-secondary");
                        document.getElementById("btn-payment").classList.remove("btn-primary");
                    }else{
                        document.getElementById("btn-payment").classList.remove("btn-secondary");
                        document.getElementById("btn-payment").classList.add("btn-primary");
                    }
                }
            };
            xmlhttp.open("GET","./server/helper/getBookingInfo.php?date="+bookingStartDate.value+"&listingId="+listingId,true);
            xmlhttp.send();  
        }
        
        // function checkStatus(e){
        //     e.preventDefault();
        
        // }
    </script>
    <script src="../sean2/home.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" 
    crossorigin="anonymous"></script>

</body>
</html>