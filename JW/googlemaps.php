<!DOCTYPE html>
<html>
  <head>

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Vuejs -->
  <!-- <script src="https://unpkg.com/vue@next"></script> -->

  <!-- importing axios -->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


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
    
    
    <h3>My Google Maps Demo</h3>
    
    <!-- INSERT CSS OR WHATEVER HERE -->


    <!--The div element for the map -->
    <!-- have a PHP to extract info from database -->
    <!-- Put the info into hidden field -->
    <?php
    include_once("common.php");
    include_once("test.php");
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
    <button id = "all" type="button" class="btn btn-primary">ALL</button>
    <div id="map"></div>

    <script>
    
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function, i.e., the initMap() function is executed as soon as the API is loaded.
    -->
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfctivjYLHPDC59EY5eCveR1G5SHVUHno&callback=initMap">
    </script>
  </body>
</html>

<!-- maps api key: AIzaSyBfctivjYLHPDC59EY5eCveR1G5SHVUHno -->
<!-- geocoding api key: AIzaSyBdKZe_tJzo2lKO1TNaA0GNB_WLZeADXPI -->
<!-- info window to get info from database or somewhere to show information when clicked on the icon, with marker.addListener as active function -->
<!-- marker.addListener('click', function(){
  infoWindow.open(map,marker); 
}); -->