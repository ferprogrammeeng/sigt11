const getId = id => document.getElementById(id);
const start = getId("start");
const end = getId("end");

let directionsService, directionsRenderer;
let startSelected = false, endSelected = false;
let map, infoWindow;
const options = {
  center: { lat: 0.45966, lng: 101.410347 }, // menentikan latitude dan longitude
  zoom: 13, // menentukan level zoom
  mapTypeId: "hybrid",
  disableDefaultUI: true,
};

function setPoint(e){
  const lat = e.latLng.lat();
  const lng = e.latLng.lng();;

  if(startSelected){
    start.value = `${lat}, ${lng}`;
  } else if(endSelected){
    end.value = `${lat}, ${lng}`;
  }

  if(start.value && end.value) calcRoute();
}

function calcRoute(){
  const [ originLat, originLng ] = start.value.split(', ');
  const [ destinationLat, destinationLng ] = end.value.split(', ');

  const origin = {
    lat: parseFloat(originLat), lng: parseFloat(originLng)
  }
  const destination = {
    lat: parseFloat(destinationLat), lng: parseFloat(destinationLng)
  }

  const request = { origin, destination, travelMode: 'DRIVING' };

  directionsService.route(request, function(result, status){
    if(status === 'OK'){
      directionsRenderer.setDirections(result);
    }
  });
}

window.onclick = function(e){
  startSelected = (e.target === start);
  endSelected = (e.target === end);

  start.style.background = startSelected ? 'lightblue' : 'initial';
  end.style.background = endSelected ? 'lightblue' : 'initial';
}

window.initMap = function(){
  // membuat peta
  map = new google.maps.Map( getId('googleMap'), options );
  map.addListener('click', setPoint);

  infoWindow = new google.maps.InfoWindow({ content: '' });

  directionsService = new google.maps.DirectionsService();
  directionsRenderer = new google.maps.DirectionsRenderer();
  directionsRenderer.setMap(map);

  lokasi.forEach(el => {
    const { name, lat, lng } = el;
    const content = `<h5>${name}</h5>`;

    const marker = new google.maps.Marker({
      map,
      position: { lat, lng },
      icon: "assets/marker-icon.jpg",
    });

    // ketika marker diklik
    marker.addListener('click', () => {
      map.setCenter({ lat, lng });

      infoWindow.setPosition({ lat, lng });
      infoWindow.setContent(content);
      infoWindow.open(map);
    });
  });
}


