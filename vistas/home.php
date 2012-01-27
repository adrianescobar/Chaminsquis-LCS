<?php
?>
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
				var strlat;
				var strlng;
				if (geocoder) {
					geocoder.geocode( 
						{'address': address}, 
						function(results, status) {
							
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
					);
					results = [strlat,strlng];					
					return results;
				}
			}
			
			/*
			function codeLatLng() {
				var input = document.getElementById("latlng").value;
				var latlngStr = input.split(",",2);
				var lat = parseFloat(latlngStr[0]);
				var lng = parseFloat(latlngStr[1]);
				var latlng = new google.maps.LatLng(lat, lng);
				if (geocoder) {
					geocoder.geocode(
						{
							'latLng': latlng
						}, 
						function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								if (results[1]) {
									$("#map_div").gmap3({action: 'setZoom', args:[14]});
									$("#map_div").gmap3({
										action: 'addMarkers',
										markers:[
											{lat:48.8620722, lng:2.352047, data:'Paris !'},
											{lat:46.59433,lng:0.342236, data:'Poitiers : great city !'},
											{lat:42.704931, lng:2.894697, data:'Perpignan ! <br> GO USAP !'}
										],
										marker:{
											options:{
												draggable: false
											},
											events:{
												mouseover: function(marker, event, data){
													var map = $(this).gmap3('get'),
														infowindow = $(this).gmap3({action:'get', name:'infowindow'});
													if (infowindow){
														infowindow.open(map, marker);
														infowindow.setContent(data);
													} else {
														$(this).gmap3({action:'addinfowindow', anchor:marker, options:{content: data}});
													}
												},
												mouseout: function(){
													var infowindow = $(this).gmap3({action:'get', name:'infowindow'});
													if (infowindow){
														infowindow.close();
													}
												}
											}
										}
									});
								}
							} else {
								alert("Geocoder failed due to: " + status);
							}
						}
					);
				}
			}*/
		</script>
	</head>
	<body onload="initialize()">
		<div id = "header">
			<?php include "header.php";?>
		</div>
		<div id = "middle">
			<!--
			<form action="#">
				<fieldset id = "fss">
					<input type="text" size="60" name="address"  id = "address" value=""/>
					<button type="button" onclick="codeAddress()">GO!</button>
				</fieldset>
				
			</form>
			-->
			<span id = "spTopLeft">
				<table id = "tabSearch"	>
					<tr>
						<td>
							<select>
								<option>Provincia Ejemplo</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<select>
								<option>ARS Ejemplo</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan = "2"><button type = "">Buscar</button></td>
					</tr>
				</table>
			</span>
			<span id = "spTopRight">
				<div class = "gmap3" id = "map_div" name = "map_div"></div>
			</span>
		</div>
		<div id = "bottom">
			<?php include "footer.php";?>
		</div>
	</body>
</html>