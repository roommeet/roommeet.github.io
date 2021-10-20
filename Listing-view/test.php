<?php
    require_once('common.php')
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
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 500,
                values: [ 75, 300 ],
                slide: function( event, ui ) {
                    $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                 }
         });
         $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
        } );
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
        form{
            border: 1px solid grey;
            padding: 5px 10px;
            font-size: x-large;
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
    </style>
    <title>View Listings</title>
</head>
<body> 
    <div class="container mx-auto">
        <row>
            <div class="header">
                <div class="hd-top">
                    <div class="logo my-3"><a href="https://placeholder.com"><img src="https://via.placeholder.com/50"></a></div>
                    <div class="hd-search my-4">
                        <h2>RoomMeet</h2>
                    </div>
                    <div class="hd-search-bar">
                        <input type="text" placeholder="Search..">
                        <button type="submit"><i class="fa fa-search"></i></button>
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
        </row>
        <row>
            <div class="content">
                <div class="room-type">
                    <a href="#" >All &emsp;|</a>
                    <a href="#" >HDB &emsp;|</a>
                    <a href="#" >Condo &emsp;|</a>
                    <a href="#" >Shop &emsp;|</a>
                    <a href="#" >Etc</a>
                </div>
                <div class="filter-room-type my-4">
                    <form>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="search-by-mrt">Search By MRT :</label>
                            <select class="select-by-mrt" id="selectByMrt">
                                <option selected>All..</option>
                                <option>East</option>
                                <option>West</option>
                                <option>Central</option>
                                <option>North</option>
                                <option>South</option>
                            </select>   
                            <select class="choose-mrt-station" id="chooseMrtStation">
                                <option selected>Bedok</option>
                                <option>Changi</option>
                                <option>Orchard</option>
                                <option>Bukit Panjang</option>
                                <option>Serangoon</option>
                                <option>Sentosa</option>
                            </select>  
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputPassword4">Residential :</label>
                            <select class="choose-room-type" id="chooseRoomType">
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
                                        <input type="text" id="amount" readonly style="border:0; color:#2c5258; font-weight:bold;"> 
                                    <div id="slider-range"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">Capacity: </label>
                                    <select class="capacity">
                                        <option selected value="1">One - Two</option>
                                        <option value="2">Three - Five</option>
                                        <option value="3">No limit</option>
                                    </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary my-2">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </row>
    </div>

    <?php
        $listingDAO = new ListingDAO();
        $listings = $listingDAO->getAll();
    ?>
    <div class="container content-images">
        <div class="content-wrapper">
            <div class="row">
                <?php foreach($listings as $listing): ?>
                <div class="col-sm-3">
                    <div class="card border border-white" style="width: 18rem;">
                        <img class="card-img-top" src="<?php echo $listing->getUrl(); ?>" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $listing->getName(); ?></h5>
                          <h6 class="card-title">Full Day S$<?php echo $listing->getPrice(); ?></h6>
                          <p class="card-text">[<?php echo $listing->getAddress();?>] [<?php echo $listing->getSize();?>sqft] [<?php echo $listing->getType(); ?>]</p>
                          <a href="#" class="btn btn-primary">Explore more</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" 
    crossorigin="anonymous"></script>

</body>
</html>