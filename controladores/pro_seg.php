<?php 
	require_once("../modelo/Hospital");
	require_once("../modelo/Insurance");
	if(isset($_GET))
	{
		$insur = new Insurance();
		$hosp = new Hospital();

		$insur->find(null, array("name" => $_GET['name'] );

		



	}
?>
