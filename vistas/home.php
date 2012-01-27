<?php
	include "../modelo/Conection.php";
	$con = Conection::connect();
?>
<html>
	<head>
		<title>LCS Home</title>
		<style media = "all" type = "text/css">@import url('../css/styles.css');</style>
		<script type = "text/javascript" src = "http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type = "text/javascript" src = "../js/jquery-ui-1.8.17.custom.min.js"></script>
		<link type = "text/css" href = "../css/custom-theme/jquery-ui-1.8.17.custom.css" rel = "stylesheet"/>
		<script type="text/javascript" src="../js/geolocalizacion.js"></script>
		<script type = "text/javascript" src = "../js/jquery-gmap3-4.1/gmap3.min.js"></script>
		<script type = "text/javascript">
			$(function(){
			
				data = geolocalizacion();
				$("#map_div").gmap3(
					{
						action: 'init',
						options:{
							center:[data.latitude,data.longitude],
							zoom:14,
							mapTypeId: google.maps.MapTypeId.ROADMAP,
							mapTypeControl: true,
							mapTypeControlOptions: {
								style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
							},
							
							navigationControl: true,
							scrollwheel: true,
							streetViewControl: true
						}						
					}
				);

				$('#map_div').gmap3({
					action: 'addMarker',
					address: ""+data.latitude+","+data.longitude,
					map:{
					center: true,
					zoom: 14
					},
					marker:{
					options:{
					draggable: false
					}
					},
					infowindow:{
					options:{
					content: 'Posicion actual'
					},
					events:{}
				}
				});

				var geocoder = null;
				
				function initialize() {

					geocoder = new google.maps.Geocoder();
					
				}
				
				function codeAddress() {
					var address = document.getElementById("address").value;
					var strlat;
					var strlng;
					if (geocoder) {
						geocoder.geocode( 
							{'address': address}, 
							function(results, status) {
								
								if (status == google.maps.GeocoderStatus.OK) {
									strlat = "" + results[0].geometry.location.lat();
									strlng = "" + results[0].geometry.location.lng();
									
								} else {
									alert("Geocode was not successful for the following reason: " + status);
								}
							}
						);
							console.log(result);
						
						};

						results = [strlat,strlng];					
						return results;
					}

					$("button").button();
					$(".headerATag").button();
				}
			}	
		</script>
	</head>
	<body onload="initialize()">
		<div id = "header">
			<?php include "header.php";?>
		</div>
		<div id = "middle">
			<div id = "spTopRight">

				<div class = "gmap3" id = "map_div" name = "map_div"></div>

			</div>
						
			<div id = "spBottonCenter">
			</div>

		</div>
		<div id = "bottom">
			<?php include "footer.php";?>
		</div>
	</body>
</html>