<?php

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "Mostrar":
			fetchAll();
			break;
		case "Conexion":
			conexionDatabase();
			break;
		case "Agregar":
			agregarMaterial();
			break;
		case "Eliminar":
			deleteMaterial();
			break;
		case "DetalleMaterial":
			fetchAllDetalleMaterial();
			break;
		default:
			echo 'error de seleccion';
			break;
	}



	// require_once("../Model/Material.php");

	function conexionDatabase(){
		require_once("../Model/AdministradorModelo.php");
		$conexionPrueba = new AdministrarModelo();
		echo json_encode($conexionPrueba->getConexion());
	}

	function fetchAll(){
		require_once("../Model/AdministrarMaterial.php");
		$materialModel = new AdministrarMaterial();
		$resultado = $materialModel->listAll();
		echo json_encode($resultado);

	}
	function agregarMaterial(){
		require_once("../Model/AdministrarMaterial.php");
		require_once("../Model/Material.php");
		$materialModel = new AdministrarMaterial();
		$curso = $_POST["curso"];
		$grado=$_POST["grado"];
		$fechaRecepcion = $_POST["fechaRecepcion"];
		$cantidad = $_POST["cantidad"];
		$tipoMaterial = $_POST["tipoMaterial"];
		$nombreMaterial = $_POST["nombreMaterial"];
		$material = new Material(null,$curso,$tipoMaterial,$grado,$fechaRecepcion,$nombreMaterial,$cantidad);
		$materialModel->Create($material);
	}

	function deleteMaterial(){
		require_once("../Model/AdministrarMaterial.php");
		$materialModel = new AdministrarMaterial();
		$idMaterial = $_POST["id"];
		$materialModel->Delete($idMaterial);
		echo json_encode("Eliminando");
	}


	function fetchAllDetalleMaterial(){
		require_once("../Model/AdministrarMaterial.php");
		$materialModel = new AdministrarMaterial();
		//$idMaterial = $_POST["id"];
		$output=$materialModel->listDetalleMaterial();
		//$resultado = $materialModel->listDetalleMaterial();
		echo json_encode($output);
	}

	
 ?>
