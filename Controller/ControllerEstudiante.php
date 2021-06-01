<?php
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "MostrarApoderado":
			fetchAll();
			break;
		default:
			echo 'error de seleccion';
			break;
	}

	
	
	// require_once("../Model/Material.php");

	

	
	
 ?>