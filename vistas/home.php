<?php?>
<html>
	<head>
		<title>LCS Home</title>
		<style media = "all" type = "text/css">@import url('../css/styles.css');</style>
		<script type = "text/javascript" src = "http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type = "text/javascript" src = "../js/jquery-gmap3-4.1/gmap3.min.js"></script>
		<script type = "text/javascript">
			$(function(){
				$("#map_div").gmap3(
					{
						action: 'init',
						options:{
							center:[18.885498,-70.489197],
							zoom:8,
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
			});
			
			var geocoder = null;
			
			function initialize() {
				geocoder = new google.maps.Geocoder();
			}
			
			function codeAddress() {
				var address = document.getElementById("address").value;
				if (geocoder) {
					geocoder.geocode( 
						{'address': address}, 
						function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								$("#map_div").gmap3({action: 'setCenter', args:[results[0].geometry.location]});
								$("#map_div").gmap3({action: 'setZoom', args:[14]});
							} else {
								alert("Geocode was not successful for the following reason: " + status);
							}
						}
					);
				}
			}
		</script>
	</head>
	<body onload="initialize()">
		<div id = "content">
			<form action="#">
				<p>
					<input type="text" size="60" name="address"  id = "address" value=""/>
					<button type = "button" onclick="codeAddress()">Go!</button>
				</p>
				<div class = "gmap3" id = "map_div" name = "map_div">
			</form>
		</div>
	</body>
</html>