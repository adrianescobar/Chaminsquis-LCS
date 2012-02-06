//Libreria Funciones Mapa y geolocalizacion

//Obtener la Psicion Actual
function geolocalizacion()
{
	if(navigator.geolocalizacion)
	{
		alert("Puede meter mano");
	}else
	{
		alert("Error de Localizacion");
	}
}

function pintarRuta(mapa,origen,destino)
{
	var directionsService = new google.maps.DirectionsService();
	var directionsDisplay = new google.maps.DirectionsRenderer();

    var myOptions = {
     zoom:7,
     mapTypeId: google.maps.MapTypeId.ROADMAP
    }

	   var map = mapa;
	   directionsDisplay.setMap(map);

	   var request = {
	       origin: origen, 
	       destination: destino,
	       travelMode: google.maps.DirectionsTravelMode.DRIVING
	   };

	   directionsService.route(request, function(response, status) {
	      if (status == google.maps.DirectionsStatus.OK) {

	      	//Distancia
	        directionsDisplay.setDirections(response);
	        $('#distance').hmtl(response.routes[0].legs[0].distance.value + "M");

	      }
	   });
}