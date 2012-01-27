<?php 
	require_once("../modelo/Hospital");
	require_once("../modelo/Insurance");
	if(isset($_GET))
	{
		$hosp = new Hospital();

		$hosp->find($_GET["seguro"], $_GET["provincia"]);
		

	}
?>
