<!Doctype html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title></title>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCLB5MsqeEErVnp1pHoJyxbzVhl_ZYOB5U&sensor=false">
    	</script>
    	<script type="text/javascript" src="../js/linq.min.js"></script>
    	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    	<script type="text/javascript" src="../js/mapaGeo.js"></script>
    	<script>
    		
    		$(document).ready(function(){
    			
    			//Evento click para el boton cargar
				$("#cargar").click(function(){
					
					//metodo ajax para la carga de datos
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

				$("<option>").attr("value","2").appendTo("#numOpciones");
					
				});

    		});

    	</script>

    <link rel="stylesheet" href="../css/style.css">
	</head>
<body onload="geolocalizacion()">
	<div>
		
		<div id="header">
			<h1>Header</h1>
		</div>

		<div id="body">

			<div id="map"></div>

			<div>
				
				<!-- <button id="cargar" onclick="alert(rutas);">Cargar2</button>
				<select id="numOpciones">

					<option value="5">Seleccione una Cantidad</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>

				</select> -->
				<div id="rutas"></div>

			</div>

		</div>

		<div id="footer">
		</div>

	</div>
</body>
</html>