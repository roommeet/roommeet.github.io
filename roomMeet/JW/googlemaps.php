<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" 
  crossorigin="anonymous">
  <!-- Vuejs -->
  <!-- <script src="https://unpkg.com/vue@next"></script> -->

  <!-- importing axios -->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <link rel="stylesheet" href="./stylesheets/login.css">
  <link rel="stylesheet" href="./stylesheets/home.css">
  <script src='https://unpkg.com/axios/dist/axios.js'></script>
  <script src="https://unpkg.com/vue@next"></script>


  <!-- script for maps and geo coding -->
  <script src = "mapsScript.js"></script>

    <style>

       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
      }
    </style>

  </head>
  
  <body>
    
  <div class="homecontainer-fluid" id="app">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a href="../sean2/home.php" class="navbar-brand" id="logoname">ROOMMEET.</a>
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
                    </ul>
                    <ul class="navbar-nav ms-auto" v-else>
                        <li class="nav-item" style="margin:auto; padding: auto;">
                            <b>Welcome, {{user.username}}! </b>
                        </li>
                        <li class="nav-item">
                            <a href="../JW/chatPage.php" class="nav-link">Chat</a>
                        </li>
                        <li class="nav-item">
                            <a href="../JW/googlemaps.php" class="nav-link">Map Listings</a>
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
    <h3>ALL AVAILABLE LISTINGS</h3>
    
    <!-- INSERT CSS OR WHATEVER HERE -->


    <!--The div element for the map -->
    <!-- have a PHP to extract info from database -->
    <!-- Put the info into hidden field -->
    <?php
    include_once("common.php");

    // Get data from database, put it into input-hidden

    // if from search page then do if   isset($_POST[]) then whatever 
    $listingDAO = new ListingDAO;
    $listings = $listingDAO->getAll();
    // var_dump($listings);
    foreach($listings as $listing){
      $name = $listing->getName();
      $price = $listing->getPrice();
      $address = $listing->getAddress();
      $type = $listing->getType();
      $size = $listing->getSize();
      $region = $listing->getRegion();
      $latitude = $listing->getLatitude();
      $longitude = $listing->getLongitude();
      echo "<input type = 'hidden' name = '$region' value = '$name/$price/$address/$type/$size/$latitude/$longitude'>";
    }
    ?>

    <!-- do a vuejs binding of sorts -->
    <button id = "north" type="button" class="btn btn-primary">North</button>
    <button id = "south" type="button" class="btn btn-primary">South</button>
    <button id = "east" type="button" class="btn btn-primary">East</button>
    <button id = "west" type="button" class="btn btn-primary">West</button>
    <button id = "central" type="button" class="btn btn-primary">Central</button>
    <button id = "all" type="button" class="btn btn-primary">ALL</button>
    <div id="map"></div>
    <script>
    
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function, i.e., the initMap() function is executed as soon as the API is loaded.
    -->
    <script src="../sean2/home.js"></script>
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfctivjYLHPDC59EY5eCveR1G5SHVUHno&callback=initMap">
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" 
    crossorigin="anonymous"></script>
  </body>
</html>

<!-- maps api key: AIzaSyBfctivjYLHPDC59EY5eCveR1G5SHVUHno -->
<!-- geocoding api key: AIzaSyBdKZe_tJzo2lKO1TNaA0GNB_WLZeADXPI -->
<!-- info window to get info from database or somewhere to show information when clicked on the icon, with marker.addListener as active function -->
<!-- marker.addListener('click', function(){
  infoWindow.open(map,marker); 
}); -->