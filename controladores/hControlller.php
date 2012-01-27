<?php
	require_once("../modelo/Hospital.php");
	require_once("../modelo/Insurance.php");

	$var1 = new Hospital();
	$var2 = new Insurance();

  	 //echo count ($var1->find(null, null, 0, 10));
  	//$variable = $var1->find(null, null, 0, 10);
  /*	for($var = 0; $var < 10; $var++)
  	{
  		echo $variable[$var][0] ."," .$variable[$var][1] ."," .$variable[$var][2] .",".$variable[$var][3]. "<br>";
  	}
  	//echo $var1->name();
  	*/
  	$var1->find("SENASA", "Santo Domingo");
?>