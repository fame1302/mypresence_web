function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  //   alert("oje");
  var lat = document.getElementById("latitude").value;
  var long = document.getElementById("longitude").value;

  if (lat == "" || long == "") {
    lat = position.coords.latitude;
    long = position.coords.longitude;
  }

  mapboxgl.accessToken =
    "pk.eyJ1IjoiZmFtZTEzMDIiLCJhIjoiY2tjaWZpZHBmMGljbjJ4cnAwcGcxcHl6dSJ9.SSEq4TmCxUfXiMK6VAC82w";
  var map = new mapboxgl.Map({
    container: "map-container",
    style: "mapbox://styles/mapbox/satellite-v9",
    center: [long, lat], // starting position [lng, lat]
    zoom: 15,
  });

  map.addControl(
    new MapboxGeocoder({
      accessToken: mapboxgl.accessToken,
      mapboxgl: mapboxgl,
    })
  );
  map.addControl(
    new mapboxgl.GeolocateControl({
      positionOptions: {
        enableHighAccuracy: true,
      },
      trackUserLocation: true,
    })
  );
  var coordinates = document.getElementById("coordinates");
  var long_label = document.getElementById("longitude");
  var lat_label = document.getElementById("latitude");

  var marker = new mapboxgl.Marker({
    draggable: true,
  })
    .setLngLat([long, lat])
    .addTo(map);

  function onDragEnd() {
    var lngLat = marker.getLngLat();
    // coordinates.style.display = "block";
    // coordinates.innerHTML =
    //   "Longitude: " + lngLat.lng + "<br />Latitude: " + lngLat.lat;
    long_label.value = lngLat.lng;
    lat_label.value = lngLat.lat;
  }

  marker.on("dragend", onDragEnd);
}
