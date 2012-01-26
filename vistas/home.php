<?php?>
<html>
	<head>
		<title>LCS Home</title>
		<style media = "all" type = "text/css">@import url('css\styles.css');</style>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="js\jquery-gmap3-4.1\gmap3.min.js"></script>
		<script>
			$(function(){
				$("#map_div").gmap3();
				$('.gmap3').gmap3(
				{
					action: 'init',
					options:{
						center:[22.49156846196823, 89.75802349999992],
						zoom:2,
						mapTypeId: google.maps.MapTypeId.SATELLITE,
						mapTypeControl: true,
						mapTypeControlOptions: {
							style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
						},
						navigationControl: true,
						scrollwheel: true,
						streetViewControl: true
					}
				});
			});
		</script>
	</head>
	<body>
		<div id = "content">
			<div class = "gmap3" id = "map_div" name = "map_div" style = "height:350px; width:600px">
		</div>
	</body>
</html>