//Libreria Funciones Mapa y geolocalizacion
function geolocalizacion()
{
	var data;
	if(navigator.geolocation)
	{
		
		navigator.geolocation.getCurrentPosition(function(position){
			
			var geocoder = new google.maps.Geocoder();

			var lat = position.coords.latitude;

			var lng = position.coords.longitude;
			
			data = "{'latitude':" + lat + ",'longitude':" + lng + "}";
			
			localStorage.setItem("data",data);

			/*****************************************************************/
			if (geocoder) {
					
					data = eval(" ( " + data + " ) ");

					geocoder.geocode( 

						{'address': data.longitude + "," + data.latitude }, 
						function(results, status) {
							console.log(results);
							if (status == google.maps.GeocoderStatus.OK) {
								strlat = "" + results[0].geometry.location.lat();
								strlng = "" + results[0].geometry.location.lng();
								/*
								$("#map_div").gmap3({action: 'setCenter', args:[results[0].geometry.location]});
								$("#map_div").gmap3({action: 'setZoom', args:[14]});
								*/
							} else {
								alert("Geocode was not successful for the following reason: " + status);
							}
						}
					)};
/*************************************************************/

		});
		
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

	      	//Distancia
	        directionsDisplay.setDirections(response);
	        $('#distance').hmtl(response.routes[0].legs[0].distance.value + "M");

	      }
	   });
}