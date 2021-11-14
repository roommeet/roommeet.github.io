<?php
    require_once('common.php');
    $region = $_GET['region'];
    $roomType = $_GET['region'];
    $capacity = $_GET['region'];
    $minPrice = $_GET['region'];
    $maxPrice = $_GET['region'];
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
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 500,
                values: [ 75, 300 ],
                slide: function( event, ui ) {
                    $( "#selectAmount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                 }
         });
         $( "#selectAmount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
        } );
    </script>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size:14px;
            color: black;
            /* background-color: transparent; */
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
        form.filter-box{
            /* border: 1px solid black; */
            padding: 5px 10px;
            font-size: x-large;
            /* background-color: rgb(245,245,245,0.8); */
            
        }
        .form-group{
            margin-top: 10px;
        }
        .select-by-mrt{
            margin-left: 20px;
        }
        .choose-room-type{
            margin-left: 20px;
        }
        .price-box{
            width: 50%;
        }
        .capacity{
            width: 30%;
            margin-left: 20px;
        }
        #amount{
            margin-left: 20px;
        }
        #slider-range{
            margin-top: 10px;
            margin-bottom: 15px;
        }
        .content{
            z-index: 10;
        }
        .content-wrapper{
            margin-bottom: 30px;
        }
        .card:hover{
            box-shadow: 1px 1px 1px 1px grey;
            cursor: pointer;
        }
        .card-img-top{
            width: 285px;
            height: 250px;
        }
        .card{
            margin-bottom: 10px;
        }
        a{
            color: black;
            text-decoration: none;
        }
        /* .mainbg {
            background: url("img/bg3.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        } */
        .overlay {
            content: "";
            position: absolute;
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
            background-color: rgba(0,0,0,0.1);
            z-index:0;
        } 
        #selectAmount{
            background: rgb(255,255,255,0);
        }
    </style>
    <link rel="stylesheet" href="css/main.css">
    <title>View Results</title>
</head>
<body>
    <!--Link with home.html--> 
    
    <!-- <div class="mainbg"> -->

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

    <div class="container mx-auto" style="background-color: rgb(255,255,255,0.7);">
        <row>
            <div class="content">
                <div class="room-type py-2">
                    <a href="view-listing.php" ><strong>All </strong>&emsp;|</a>
                    <a href="#" onclick="showHDB()" ><strong>HDB </strong>&emsp;|</a>                    
                    <a href="#" onclick="showCondo()"><strong>Condo </strong>&emsp;|</a>
                    <a href="#" onclick="showShop()"><strong>Shop </strong> &emsp;|</a>
                    <a href="#" onclick="showEtc()"><strong>Etc</strong></a>
                </div>
                <div class="filter-room-type my-4">
                    <form class="filter-box">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="search-by-mrt">Search By Region :</label>
                            <select class="select-by-mrt" id="selectByRegion">
                                <option selected>All</option>
                                <option>East</option>
                                <option>West</option>
                                <option>Central</option>
                                <option>North</option>
                                <option>South</option>
                            </select>   
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputPassword4">Residential :</label>
                            <select class="choose-room-type" id="selectRoomType">
                                <option selected>All</option>
                                <option>Condo</option>
                                <option>HDB</option>
                                <option>Office</option>
                                <option>Others</option>
                            </select>  
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <div class="price-box">
                                        <label for="amount">Any Price: </label>
                                        <input type="text" id="selectAmount" readonly style="border:0; color:#2c5258; font-weight:bold;"> 
                                    <div id="slider-range"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">Capacity: </label>
                                    <select class="capacity" id="selectCapacity">
                                        <option selected value="1">Single</option>
                                        <option value="2">Group - less than three</option>
                                        <option value="3">Group - more than three</option>
                                    </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary my-2" id="search-btn" onclick="showSearchResult()">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </row>
    </div>

    <?php
        require_once("./server/helper/getResult2.php");
        $arrayA = filterByPrice($minPrice, $maxPrice);
        $arrayB = filterByRoomType($roomType);
        $arrayC = filterByRegion($region);
        $arrayD = filterByCapacity($capacity);
        $comb1 = compareListingArr($arrayA, $arrayB);
        $comb2 = compareListingArr($arrayC, $arrayD);
        $listings = compareListingArr($comb1, $comb2);
    ?>
    <div class="container content-images">
        <div class="content-wrapper">
            <div class="row" id="display-result">
                <?php foreach($listings as $listing): ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card border border-white" style="width: 18rem;">
                        <img class="card-img-top" src="<?php echo $listing->getUrl(); ?>" alt="Card image cap">
                        <div class="card-body">
                            
                          <h5 class="card-title"><?php echo $listing->getName(); ?></h5>
                          <h6 class="card-title">Full Day S$<?php echo $listing->getPrice(); ?></h6>
                          <p class="card-text">[<?php echo $listing->getAddress();?>] [<?php echo $listing->getSize();?>sqft] [<?php echo $listing->getType(); ?>]</p>
                          <form method="post" action="view-details.php" class="justify-content-center">
                          <input type="hidden" id="listingId" name="listingId" value=<?php echo $listing->getID();?>>
                          <button type="submit" class="btn btn-primary">Explore more</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
               
            </div>
        </div>
        
        
        
    </div>
    <!-- </div> -->
    
    <script type='text/javascript'>
        
        var result = document.getElementById("display-result");
        var region = document.getElementById("selectByRegion");
        var roomType = document.getElementById("selectRoomType");
        var capacity = document.getElementById("selectCapacity");
        
        
        function showSearchResult(){
            var minPrice = $('#slider-range').slider("values")[0];
            var maxPrice = $('#slider-range').slider("values")[1];  
            console.log(minPrice, maxPrice);
            //result.innerHTML = region.value+" "+roomType.value+" "+minPrice+" "+maxPrice+" "+capacity.value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        result.innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","./server/helper/getResult.php?region="+region.value+"&roomType="+roomType.value+"&minPrice="+minPrice+"&maxPrice="+maxPrice+"&capacity="+capacity.value,true);
            xmlhttp.send();
        }

        function showHDB(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        result.innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","./server/helper/getResult.php?region=All"+"&roomType=HDB"+"&minPrice=0"+"&maxPrice=99999"+"&capacity=1",true);
            xmlhttp.send();
        }

        function showCondo(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        result.innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","./server/helper/getResult.php?region=All"+"&roomType=Condo"+"&minPrice=0"+"&maxPrice=99999"+"&capacity=1",true);
            xmlhttp.send();
        }

        function showShop(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        result.innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","./server/helper/getResult.php?region=All"+"&roomType=Shop"+"&minPrice=0"+"&maxPrice=99999"+"&capacity=1",true);
            xmlhttp.send();
        }

        function showEtc(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        result.innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","./server/helper/getResult.php?region=All"+"&roomType=Etc"+"&minPrice=0"+"&maxPrice=99999"+"&capacity=1",true);
            xmlhttp.send();
        }
    </script>
    <script src="../sean2/home.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" 
    crossorigin="anonymous"></script>

</body>
</html>