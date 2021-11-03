function initMap() {
  
  
  function callGeocode(){
    // get the document elements that contain the location
    
    // change the document element to the lat lng
    console.log("testing geocode order this will come first amzing")
    var rawLocations = document.getElementsByTagName("input");
    // console.log(rawLocations[3])
    // console.log(rawLocations)
    // var coordArray = [];
    var counter = 0;
    // TRY USE FOR LOOP TO ITERATE THROUGH NUMBERS THEN CALL AXIOS FOR THIS
    // store the results in an array, then loop thru the rawlocations to add in the coords
    for (rawInfo of rawLocations){
        // console.log(rawInfo)
        info = rawInfo.value.split(",");
        // console.log(info[2] +","+ info[3]);
        var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + info[2] + "," + info[3] + "&key=" + "AIzaSyBdKZe_tJzo2lKO1TNaA0GNB_WLZeADXPI";
        url = encodeURI(url);
        // console.log(url)

        // axios call to get the lat lng then rawInfo.value += ""
        axios.get(url)
        .then(
            response=>{
                // console.log(rawInfo)
                coordinates = response.data.results[0].geometry.location;
                // coordArray.push(coordinates)
                // console.log(coordinates)
                // rawInfo.value += "," + latitude + "," +longitude
                // console.log(coordArray)
                // directly manipulate here la fk idiot
                // try to for loop another rawLocations should work using counter 
                // console.log(rawLocations[counter])
                // cock
                // console.log(counter)
                // console.log(coordinates.lat)
                // rawLocations[counter].value += "," + coordinates.lat + "," + coordinates.lng
                console.log(coordinates)
                // console.log(rawLocations[counter])
                addMarker(rawLocations[counter], coordinates)
                counter++;
                // console.log(rawLocations[counter].value)
                
            }
        )
        .catch(
            
        )
    }
    // for (rawInfo of rawLocations){console.log(rawInfo)}
    
}
    
    callGeocode()


    console.log("test maps order")
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

  // var allLocations = document.getElementsByTagName("input");
  // for (locale of allLocations){
  //   addMarker(locale); 
  // }



  // function to add markers, and infowindow when opened
  
  function addMarker(informations, coordinates){
    // console.log(informations)
    locality = informations.value
    // console.log(locality)
    localityArray = locality.split(",")
    // localityArray = locale.value.split(",")
    // console.log(localityArray);
    var coords = {lat: coordinates.lat, lng: coordinates.lng}
    // console.log(coords)
    // console.log(informations)
    var content = "Name: " + localityArray[0].trim() + "</br>" + "Type: " + localityArray[4].trim() + "</br>" + "Address: " + localityArray[2].trim() + localityArray[3] + "</br>" + "Price: $" + localityArray[1].trim();
    // console.log(content);
    var icon = {
    url: "./img/download.png", // url
    scaledSize: new google.maps.Size(40, 40), // scaled size
    };
    var marker = new google.maps.Marker({position: coords, map: map, icon:icon});
    var infoWindow = new google.maps.InfoWindow({
      // info will be the name, price address etc
      content: content
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