<?php
	require_once("../modelo/Hospital.php");

	$var = new Hospital();
	echo count ($var->find('and', array('id_hospital' =>  '1', 'provincia' => 'santo domingo')));

	echo $var->name();

?>