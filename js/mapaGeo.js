//Libreria Funciones Mapa y geolocalizacion

rutas = [];

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


//Pinta Las Rutas
function pintarRuta2(map,origen,destino){

   var directionsService = new google.maps.DirectionsService();
   var directionsDisplay = new google.maps.DirectionsRenderer();

   //pongo donde sera msotrado la ruta osea el mapa
   directionsDisplay.setMap(map);
   		
   		info = new google.maps.InfoWindow({content: 'Wohoooo, salió el InfoWindow cuando pulsé el marcador, pero ¿hay más?'});
   		
     //  market = new google.maps.Marker({
	    //     position: origen
	    //     , map: map
	    //     , title: 'Pulsa aquí'
	    //     , icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/pink/blank.png'
	    // });


   // directionsDisplay.setOptions({
   // 		draggable:true,
   // 		suppressInfoWindows:true,
		 //  infoWindow: info
   // });

   info.open(map);

   //consulta para la ruta el origen es pasado con cordenadas el destino con una direccion
   prompt("",destino.direccion +  " santo domingo");
   
   var request = {
       origin: origen, 
       destination: destino.direccion,
       travelMode: google.maps.DirectionsTravelMode.DRIVING
   };

   directionsService.route(request, function(response, status) {	
      if (status == google.maps.DirectionsStatus.OK) {

         // Display the distance:
         //document.getElementById('distance').innerHTML += response.routes[0].legs[0].distance.value + " Metros";
          div = $("<div>");
          $("<span>").text(destino.nombre || destino.direccion).appendTo(div);
          $("<span>").text(conver(response.routes[0].legs[0].distance.value)).appendTo(div);
         
            
            //Agregar la distancia de cada uno a un array
            rutas.push({"nombre":destino.nombre,"distancia":conver(response.routes[0].legs[0].distance.value)});
           
          //$("<span>").text(destino.nombre).appendTo(div);
          div.appendTo("#rutas");

         // Display the duration:
         //document.getElementById('duration').innerHTML += 
           // response.routes[0].legs[0].duration.value + " seconds";

         directionsDisplay.setDirections(response);
         //console.log(rutas.sort());

      }else
      {
        alert("Error con la Direccion" + destino.direccion);
      }
   });

}


function capturarDistancias(map,origen,destino){

   var directionsService = new google.maps.DirectionsService();
   var directionsDisplay = new google.maps.DirectionsRenderer();

   //pongo donde sera msotrado la ruta osea el mapa
   directionsDisplay.setMap(map);
   
   var request = {
       origin: origen, 
       destination: destino.direccion,
       travelMode: google.maps.DirectionsTravelMode.DRIVING
   };

   directionsService.route(request, function(response, status) {  

      if (status == google.maps.DirectionsStatus.OK) { 

        //Agregar la distancia de cada uno a un array
        rutas.push([response.routes[0].legs[0].distance.value,destino]);  
        
      }else
      {
        console.log("Error");
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
        
    //crear la instancia del mapa
    var map = new google.maps.Map(document.getElementById("map"),myOptions);

    //Crea el marcador de posicion actual
    //crearMarcador(map,new google.maps.LatLng(lat,lng));

    detino = null;

    direccion = document.location.href.split("?")[1];

    //si no hay parametros en la ruta no indicara a nada
    if(direccion!=null)
    {
    	destino = direccion.split("=")[1];
    	destino = destino.replace(/%20/gi," ");
    }else
    {

    	destino = 0;

    }

    if(destino!=0){
      
      pintarRuta2(map,new google.maps.LatLng(lat,lng),{direccion:destino});

    }else
    {
      //prompt("",lat + " " + lng);
      crearMarcador(map,new google.maps.LatLng(lat,lng));

       // pitara todas las rutas en el mapa
        $.ajax({
         url:"../controladores/hControlller.php",
         success:function(data){

           for(i=0;i<data.hospitales.length;i++)
           {
            capturarDistancias(map,new google.maps.LatLng(lat,lng),data.hospitales[i]);
           }
          console.log(map);
           setTimeout(function(){
             pintarRutaTop(map,new google.maps.LatLng(lat,lng));
           },4000);
           //resultado = Enumerable.From(window.rutas).Select(function(a){return a[0]}).ToArray();
           
         },
         type:'get',
         dataType:'json'
        });
    }
}

function pintarRutaTop(map,origen)
{
  console.log(map);
  select = document.getElementById("numOpciones");

  take = select.options[select.selectedIndex].value;

  resultado = Enumerable.From(window.rutas).OrderBy(function(x){return x[0];}).Take(take).ToArray();
  
  for(i =0;i<resultado.length;i++)
  {
    console.log(resultado[i]);
    pintarRuta2(map,origen,resultado[i][1]);
  }
  
}

//Me Retornada si puede ir en metros o en Km resivira un int en metros
function conver(distancia)
{
    if(distancia<1000)
    {

      return distancia + "Metros";

    }else
    {
      
      return (distancia/1000).toFixed(2) + "Km";

    }
}

function crearMarcador(map,pos)
{
	marcador = new google.maps.Marker({
        position: pos
        , map: map
        , title: 'Usteb Esta Aqui'
        , icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/green/blank.png'
        , cursor: 'default'
        , draggable: true
    });

    crearInfo(map,pos,"Usteb Esta Aqui",marcador)
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