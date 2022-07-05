  // In the following example, markers appear when the user clicks on the map.
// The markers are stored in an array.
// The user can then click an option to hide, show or delete the markers.
let map;
let markers = [];

function initMap() {
 
  // localizacion inicial
  const inicial = { lat: latitud, lng:  longitud};
  
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 15,
    center: inicial,
  /*   mapTypeId: "terrain", */
  });
  // This event listener will call addMarker() when the map is clicked.
  map.addListener("click", (event) => {
    addMarker(event.latLng);
  });
  // Adds a marker at the center of the map.
  addMarker(inicial);
}

// Adds a marker to the map and push to the array.
function addMarker(location) {
  const marker = new google.maps.Marker({
    position: location,
    map: map,
  });
  clearMarkers();

  markers.push(marker);

  console.log(marker.position.lat(), marker.position.lng());
  
  $('#coords_map_lat').val(marker.position.lat());
  $('#coords_map_lng').val(marker.position.lng());
  
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
  for (let i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setMapOnAll(null);
}
/* 
// Shows any markers currently in the array.
function showMarkers() {
  setMapOnAll(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
}
 */