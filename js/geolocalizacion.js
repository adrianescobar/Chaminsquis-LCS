//Libreria Funciones Mapa y geolocalizacion
function geolocalizacion()
{
	
	if(navigator.geolocation)
	{
		

		navigator.geolocation.getCurrentPosition(function(position){
			
			var lat = position.coords.latitude;
			var lng = position.coords.longitude;

			data = "{'latitude':" + lat + ",'longitude':" + lng + "}";
 
			localStorage.setItem("data",data);

		});

		return eval("("+ localStorage.getItem("data") +")");;
			
	}else{
		
		alert("Geolocalizacion No Soportada");

	}
}


