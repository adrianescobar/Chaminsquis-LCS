//Libreria Funciones Mapa y geolocalizacion
function geolocalizacion()
{
	var data;
	if(navigator.geolocation)
	{
		
		navigator.geolocation.getCurrentPosition(function(position){
			
			var lat = position.coords.latitude;
			var lng = position.coords.longitude;

			data = "{'latitude':" + lat + ",'longitude':" + lng + "}";
 
			localStorage.setItem("data",data);

		});
		alert(data);
		return eval("("+ localStorage.getItem("data") +")");;
			
	}else{
		
		alert("Geolocalizacion No Soportada");

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

	        directionsDisplay.setDirections(response);
	        $('#distance').hmtl(response.routes[0].legs[0].distance.value + " meters");

	      }
	   });
}