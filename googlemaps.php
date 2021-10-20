<!DOCTYPE html>
<html>
  <head>

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Vuejs -->
  <!-- <script src="https://unpkg.com/vue@next"></script> -->

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
    include_once("test.php");
    foreach($test as $place){
      $region = $place[0];
      $locationName = $place[1];
      $lat = $place[2];
      $lng = $place[3];
      $placeName = $place[4];
      // change into <input name ="west" etc so can get html collection>
      echo "<input type = 'hidden' name = '$region' value = '$locationName,$lat,$lng,$placeName'></input>";
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
  
  
// Initialize and add the map
  function initMap() {
    
    // var ntu = {lat: 1.3483, lng: 103.6831};
    // var scis = {lat: 1.297538, lng: 103.849558};
    // var scid = {lat: 1.2966, lng: 103.7764};
    singapore = {lat: 1.3521, lng: 103.8198}
    
    
    // The map, centered at SMU
    var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 12, center: singapore});


  // get ALL locations by using document.getElementsByTagName("input")
  // Get all locations that were retrieved from DB and then addmarker for each location
  var southMarkers = [];  
  var northMarkers = [];
  var westMarkers = [];
  var eastMarkers = [];
  var allMarkers = [];

  var allLocations = document.getElementsByTagName("input");
  for (locale of allLocations){
    addMarker(locale); 
  }

  // get location details by region using document.getElementsByName
    // var regional = document.getElementsByName('west');
    // console.log(regional)
    // this gives the relevant information that we need to construct the map
    // console.log(regional[0].value)


  // function to add markers, and infowindow when opened
  
  function addMarker(informations){
    locality = informations.value
    localityArray = locale.value.split(",")
    var coords = {lat: Number(localityArray[1]), lng: Number(localityArray[2])}
    // console.log(coords)
    // console.log(informations)
    var icon = {
    url: "./img/download.png", // url
    scaledSize: new google.maps.Size(40, 40), // scaled size
    };
    var marker = new google.maps.Marker({position: coords, map: map, icon:icon});
    var infoWindow = new google.maps.InfoWindow({
      // info will be the name, price address etc
      content:localityArray[3]
    });
    marker.addListener("click", function(){
      infoWindow.open(map, marker);
    });
    // push corresponding markers into the regionarray
    if (informations.name == "north"){
      northMarkers.push(marker);
    } else if(informations.name == "south"){
      southMarkers.push(marker);
    } else if(informations.name == "east"){
      eastMarkers.push(marker);
    } else{
      westMarkers.push(marker);
    }
    allMarkers.push(marker);
    // console.log(northMarkers);
    // console.log(allMarkers);
  }
  

  document.getElementById("north").addEventListener("click", function(){
      showMarkers(northMarkers)
    });
  document.getElementById("east").addEventListener("click", function(){
      showMarkers(eastMarkers)
    });
  document.getElementById("south").addEventListener("click", function(){
      showMarkers(southMarkers)
    });
  document.getElementById("west").addEventListener("click", function(){
      showMarkers(westMarkers)
    });
  document.getElementById("all").addEventListener("click", function(){
      showMarkers(allMarkers)
    });


  function setMapOnAll(map, markers) {
    // console.log(northMarkers.length);

  for (let i = 0; i < markers.length; i++) {
    // console.log(markers[i])
    markers[i].setMap(map);
  }
}


  function hideMarkers() {
    setMapOnAll(null, allMarkers);
  }
    
  function showMarkers(region){
    hideMarkers();
    // console.log(allMarkers)
    // if(region == "northMarkers"){
      setMapOnAll(map, region);
    // }
    // console.log(map)
  }
  
}
//  addeventlistener to the buttons then link them to the function
  // document.getElementById("")
  
 
    

  

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

<!-- api key: AIzaSyBfctivjYLHPDC59EY5eCveR1G5SHVUHno -->
<!-- info window to get info from database or somewhere to show information when clicked on the icon, with marker.addListener as active function -->
<!-- marker.addListener('click', function(){
  infoWindow.open(map,marker); 
}); -->