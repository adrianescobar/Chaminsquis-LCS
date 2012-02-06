<?php
	require_once("../modelo/Hospital.php");
	require_once("../modelo/Insurance.php");

	$var1 = new Hospital();
	$var2 = new Insurance();

  	$var1->find("SENASA", "Santo Domingo");
?>