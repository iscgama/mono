<?php

	include 'globals.php';

	try {
		$con = new PDO("mysql:host=" . $servidorbd . ";dbname=" . $bd, $userbd, $passbd);
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}

?>