let map;
let marker;
let geocoder;
let responseDiv;
var latitud="";
var longitud="";
const inputText = document.getElementById("inputText");
const submitButton = document.getElementById("submitButton");
const clearButton = document.getElementById("clearButton");
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    center: { lat: 4.570868, lng: -74.297333 },
    mapTypeControl: false,
  });
  geocoder = new google.maps.Geocoder();

  marker = new google.maps.Marker({
    map,
  });
  map.addListener("click", (e) => {
    geocode({ location: e.latLng });
  });
  submitButton.addEventListener("click", () =>
    geocode({ address: inputText.value })
  );
  clearButton.addEventListener("click", () => {
    clear();
  });
  clear();
}

function clear() {
  marker.setMap(null);
}

function geocode(request) {
  clear();
  geocoder
    .geocode(request)
    .then((result) => {
      const { results } = result;

      map.setCenter(results[0].geometry.location);
      marker.setPosition(results[0].geometry.location);
      marker.setMap(map);
      //json para obtener latitud y longitud
       var ubi =JSON.stringify(result, null, 2);
       
       var data = JSON.parse(ubi);

      // Obtener las variables deseadas
      var direccion = data.results[0].formatted_address;
      inputText.value= direccion;
      latitud = data.results[0].geometry.location.lat;
      longitud = data.results[0].geometry.location.lng;
      Coordenadas(latitud,longitud);
      

      return results;
    })
    .catch((e) => {
      alert("Geocode was not successful for the following reason: " + e);
    });
}

window.initMap = initMap;