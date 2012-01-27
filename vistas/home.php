<?php?>
<html>
	<head>
		<title>LCS Home</title>
		<style media = "all" type = "text/css">@import url('../css/styles.css');</style>
		<script type = "text/javascript" src = "http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type = "text/javascript" src = "../js/jquery-gmap3-4.1/jquery/jquery-1.4.4.min.js"></script>
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
		</script>
	</head>
	<body>
		<div id = "content">
			<div class = "gmap3" id = "map_div" name = "map_div">
		</div>
	</body>
</html>