<?php
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "MostrarApoderado":
			fetchAllApoderado();
			break;
		default:
			echo 'error de seleccion';
			break;
	}

	
	function fetchAllApoderado(){
		require_once("../Model/AdministrarEstudiante.php");
		$administrarEstudiante = new AdministrarEstudiante();
		$apoderados = $administrarEstudiante->listAllApoderados();
		echo json_encode($apoderados); 
	}
	// require_once("../Model/Material.php");

	

	
	
 ?>