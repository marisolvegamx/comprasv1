
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Maps</title>
	<style>
	body{
	display:flex;6
	justify-content: center;
	align-items: center;
	min-height: 100vh;

}

#map {
	height: 80vh;
	width: 80vw;
}
</style>	

</head>

<body>
<div>
<button type="button" onclick="return findMe();">Mostrar ubicación </button>

</div>	
<div id="map"></div>
<script>

function initMap() {
  var map, InfoWindow
      const myLatLng = {lat:19.36884, lng:-99.16410}
      const svgMarker ={
      	fillColor: "blue",
      	scale: 2,
      }
      

    map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 19.36884, lng: -99.16410},
                zoom: 15
              });
 
   
    directionSetup = function() {
          directionsService = new google.Maps.DirectionsService();
          directionsDisplay = new google.maps.DirectionsRenderer({

          });

          directionsDisplay.SetMap(map);
          directionsDisplay.setPanel($Selectors.dirSteps[0]);
          directionsDisplay.setDirections(response)
    },

      marker= new google.maps.Marker({
      position: myLatLng,
      map,
     });
  
   

    marker.addlistener("click", (mapsMouseEvent) => {
      position: mapsMouseEvent.Latlng,
      InfoWindow.open({  
        shoulfocus:false,
     });

      // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: mapsMouseEvent.latLng,
    });

    infoWindow.setContent(
      JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
    );
    infoWindow.open(map);

    })
}
 

   function findMe(){
   var output = document.getElementById('map');

   if (navigator.geolocation){
   	   confirm("Tu navegador soporta Geolocalizacion");
   	   output.innerHTML = "<p>Tu navegador soporta Geolocalizacion</p>";

   } else{
       confirm("Tu navegador NO soporta Geolocalizacion");
   	   output.innerHTML = "<p>Tu navegador NO soporta Geolocalizacion</p>";
   }

    
  //   const onErrorDeUbicaacion =err => {
  //       console.log("Error obteniendo ubicacion: ", err);
  //   }

    const opcionesDeSolicitud = {
      enableHighAcurrancy: true,
      maximumAge: 0,
      timeout : 5000
    };

     //solicitar
    // navigator.geolocation.getCurrentPosition(onUbicacionConcedida,onErrorDeUbicaacion, opcionesDeSolicitud);

   function localizacion (posicion){
   	var latitude = posicion.coords.latitude;
   	var longitude = posicion.coords.longitude;

    var jsonTexto ='coordenadas: {"latitude" :,' +latitude+', "longitud" :,'+longitude+'}';

   //output.innerHTML = "<p>latitude: "+latitude+"<br>longitud "+longitude+"</p>";
    output.innerHTML = jsonTexto;
   // return jsonTexto;
    const RUTA_API = "./loguear.php";


   const enviarAServidor = ubicacion => {
    // Debemos crear otro objeto porque el que nos mandan no se puede codificar
    const otraUbicacion = {
      coordenadas: {
        latitud: latitude,
        longitud: longitude,
      },
      //timestamp: posicion.timestamp,
    };

    //output.innerHTML '<p>Enviando: '+otraUbicacion+'</p>';
    
    fetch(RUTA_API, {
      method: "POST",
      body: JSON.stringify(jsonTexto),
    }); // No esperamos el then porque no hacemos nada cuando se termine
  };

   const loguear = texto => {
    $log.innerText += "\n" + texto;
  };

   }

   function error(){
   	 output.innerHTML = "<p>No se pudo obtener tu ubicacion </p>";
   }


   navigator.geolocation.getCurrentPosition(localizacion,error,opcionesDeSolicitud);
}

</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANZ_tj0m9KI-W0MZKmXImqpH_V6AkJgfI&callback=initMap"></script>	

 <?php
   //$json = localizacion();
 //  echo $jsonTexto;
 ?>

</body>
</html>   
