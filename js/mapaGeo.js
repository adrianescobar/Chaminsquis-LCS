//Libreria Funciones Mapa y geolocalizacion

//Obtener la Psicion Actual
function geolocalizacion()
{
	if(navigator.geolocation)
	{

		navigator.geolocation.getCurrentPosition(function(position){
			
			lat = position.coords.latitude;
			lng = position.coords.longitude;

			init(lat,lng)

		});
	}else
	{
		alert("Error de Localizacion");
	}
}

function cargarHospitales()
{
	
	$("#cargar").click(function(){
		
		$.ajax({
			url:"../controladores/hControlller.php",
			success:function(data){

				for(i=0;i<data.hospitales.length;i++)
				{
					$("<a>").attr("href","home.php?direccion="+data.hospitales[i].direccion).text(data.hospitales[i].nombre).addClass("rutas").appendTo("#rutas");
					
				}

			},
			type:'get',
			dataType:'json'
		});

		
	});

}

function pintarRuta2(map,origen,destino){

   var directionsService = new google.maps.DirectionsService();
   var directionsDisplay = new google.maps.DirectionsRenderer();

   directionsDisplay.setMap(map);

   var request = {
       origin: origen, 
       destination: destino +" santo domingo",
       travelMode: google.maps.DirectionsTravelMode.DRIVING
   };

   directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {

         // Display the distance:
         //document.getElementById('distance').innerHTML += 
           // response.routes[0].legs[0].distance.value + " meters";

         // Display the duration:
         //document.getElementById('duration').innerHTML += 
           // response.routes[0].legs[0].duration.value + " seconds";

         directionsDisplay.setDirections(response);
         //Este atributo tiene la posicion actual y la calle osea 2 formas de llegar via direcion y geo
         console.log(response);
      }
   });

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
	       	origin: new google.maps.LatLng(50.82788, 3.26499),
        	destination: new google.maps.LatLng(50.82788, 3.26499),
	       	travelMode: google.maps.DirectionsTravelMode.DRIVING
	   };

	   directionsService.route(request, function(response, status) {
	      if (status == google.maps.DirectionsStatus.OK) {

	      	//Distancia
	        directionsDisplay.setDirections(response);
	        //$('#distance').hmtl(response.routes[0].legs[0].distance.value + "M");

	      }
	   });
}

function init(lat,lng) {

    var myOptions = {
      center: new google.maps.LatLng(lat,lng),
      zoom: 14,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
        
    var map = new google.maps.Map(document.getElementById("map"),
        myOptions);

    crearMarcador(map,new google.maps.LatLng(lat,lng));

    detino = null;

    direccion = document.location.href.split("?")[1];

    if(direccion!=null)
    {
    	destino = direccion.split("=")[1];
    	destino = destino.replace(/%20/gi," ");
    }else
    {
    	destino = 0;
    }

    //mostrara la direccion del destino
    // alert(destino);



  //   $.ajax({
		// 	url:"../controladores/hControlller.php",
		// 	success:function(data){

		// 		for(i=0;i<data.hospitales.length;i++)
		// 		{
		// 			pintarRuta2(map,new google.maps.LatLng(lat,lng),data.hospitales[i].direccion);
					
		// 		}

		// 	},
		// 	type:'get',
		// 	dataType:'json'
		// });

    pintarRuta2(map,new google.maps.LatLng(lat,lng),destino);

    cargarHospitales();
}

function crearMarcador(map,pos)
{
	console.log(map.getCenter());
	marcador = new google.maps.Marker({
        position: pos
        , map: map
        , title: 'Estas Aqui'
        , icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/green/blank.png'
        , cursor: 'default'
        , draggable: true
    });

    crearInfo(map,pos,"Hola gente",marcador)
}

function crearInfo(map,pos,info,marcador)
{
	var popup = new google.maps.InfoWindow({
        content: info
        , position: pos
    });

    google.maps.event.addListener(marcador, 'click', function(){
        popup.open(map, marcador);
    });
}