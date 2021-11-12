<?php
    require_once('common.php');
    require_once('server/helper/reviewFunctions.php');
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
    <script>
    </script>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size:14px;
            color: black;
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
            width:120px;
            clear:left;
            text-align:right;
            padding-right:10px;
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
    <title>View Details</title>
</head>
<body> 
    <div class="container mx-auto">
        <div class="row">
            <div class="header">
                <div class="hd-top">
                    <div class="logo my-3"><a href="https://placeholder.com"><img src="https://via.placeholder.com/50"></a></div>
                    <div class="hd-search my-4">
                        <h2>RoomMeet</h2>
                    </div>
                    <div class="hd-search-bar">
                        <input type="text" placeholder="Search..">
                        <button type="submit"><a href="view-listing.php"><i class="fa fa-search"></a></i></button>
                    </div>
                </div>
                <div class="hd-top-nav">
                    <a href="#" >nav</a>
                    <a href="#" >nav</a>
                    <a href="#" >nav</a>
                    <a href="#" >nav</a>
                    <a href="#" >nav</a>
                    <a href="#" class="float-right" >login</a>
                    <a href="#" class="float-right">Sign Up</a>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <?php
        $listingId = $_POST['listingId'];
        $listingDAO = new ListingDAO();
        $listing_obj = $listingDAO->get($listingId);
    ?>
    
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-sm-6 my-3">
                <h2 class="card-title"><?php echo $listing_obj->getName(); ?></h2>
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
        <div class="row justify-content-center">
            <div class="col-sm-6 my-2">
                <div class="card border border-white">
                    <div class="card-body">
                        <?php
                            $availability = $listing_obj->getBooked();
                            if($availability=="No"){
                                echo '<h6 class="card-title float-right text-primary">Avaialable for Booking</h6>';
                            }else if($availability=="Fully"){
                                echo '<h6 class="card-title float-right text-danger">Currently not Available</h6>';
                            }else if($availability=="halfAm"){
                                echo '<h6 class="card-title float-right text-info">Avaialable after 3pm Today</h6>';
                            }else if($availability=="halfPm"){
                                echo '<h6 class="card-title float-right text-info">Avaialable before 3pm Today</h6>';
                            }
                        ?>
                        <h5 class="card-title">S$<?php echo $listing_obj->getPrice(); ?> /day</h5>
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
                            <a href="#" class="btn btn-primary my-3" onclick=booking()>Make Booking Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="hidden-form" class="container bg-light">
        <div class="row d-flex align-items-center">
            <div class="col-sm-4">
                <h3>Room Details</h3>
                <div class="booking-date m-2">
                    <label for="start">Select date:</label>
                    <input type="date" id="start" name="booking-start" value="<?php echo date("Y-m-d")?>" min="2021-10-31" max="2021-12-31">
                </div>
                <br>
                <div class="booking-option m-2">
                    <label for="start">Booking option:</label>
                    <select id="cars">
                        <option selected value="full">Full day</option>
                        <option value="halfAm">8pm ~ 3pm</option>
                        <option value="halfPm">3pm ~ 10pm</option>
                    </select>
                </div>
                
            </div>
            <div class="col-sm-4">
                <h3>Contact Details</h3>
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
            <div class="col-sm-4">
                <h3>Payment Options</h3>
                <input type="checkbox" id="visa" name="visa" value="visa" style="float:none;">
                <label for="1"> VISA/Master</label><br>
                <input type="checkbox" id="Paypal" name="Paypal" value="Paypal" style="float:none;">
                <label for="2"> Paypal</label><br>
                <input type="checkbox" id="QR" name="QR" value="QR" style="float:none;">
                <label for="3"> QR</label><br>
            </div>
        </div>
        <div class="btn-wrapper text-center my-3">
            <a href="#" class="btn btn-primary my-3" onclick=payment()>Make Payment</a>
        </div>
    </div>

    <script>
        document.getElementById("bar-1").style.width = "<?php echo (intval(countEach(1)["1"])/getSize(1)*100); ?>%";
        document.getElementById("bar-2").style.width = "<?php echo (intval(countEach(1)["2"])/getSize(1)*100); ?>%";
        document.getElementById("bar-3").style.width = "<?php echo (intval(countEach(1)["3"])/getSize(1)*100); ?>%";
        document.getElementById("bar-4").style.width = "<?php echo (intval(countEach(1)["4"])/getSize(1)*100); ?>%";
        document.getElementById("bar-5").style.width = "<?php echo (intval(countEach(1)["5"])/getSize(1)*100); ?>%";

        document.getElementById("hidden-form").style.display="none";                    

        function booking(){
            const form = document.getElementById("hidden-form");
            form.style.display="block";
        }
        $('input[type="checkbox"]').on('change', function() {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" 
    crossorigin="anonymous"></script>

</body>
</html>