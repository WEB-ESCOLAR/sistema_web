<?php
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "MostrarEstudiante":
			fetchAllEstudiante();
			break;
		default:
			echo 'error de seleccion';
			break;
	}


	function conexionDatabase(){
		require_once("../Model/AdministradorModelo.php");
		$conexionPrueba = new AdministrarModelo();
		echo json_encode($conexionPrueba->getConexion());
	}

	function fetchAllEstudiante(){
		require_once("../Model/AdministrarEstudiante.php");
		$estudianteModel = new AdministrarEstudiante();
		$resultado = $estudianteModel->listaEstudiantes();
		echo json_encode($resultado);

	}


	// require_once("../Model/Material.php");





 ?>
