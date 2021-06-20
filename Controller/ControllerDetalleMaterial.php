<?php 

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "filtrarDetalleMaterial":
			listFiltroDetalleMaterial();
			break;
		// case "detalleMaterialPrestado":
		// 	prestadoDetalleMaterial();
		// 	break;
		// case "detalleMaterialDevuelto":
		// 	devueltoDetalleMaterial();
		// 	break;
		default:
			echo 'error de seleccion';
			break;
	}

	// function showListDetalleMaterial()
	// 	require_once("../Model/AdministrarDetalleMaterial.php");
	// 	$materialModel = new AdministrarDetalleMaterial();
	// 	// $estado = $_GET["estado"];
	// 	$resultado = $materialModel->disponibleDetalleMaterial("DISPONIBLE");
	// 	echo json_encode($resultado);
	// }

	// function prestadoDetalleMaterial(){
	// 	require_once("../Model/AdministrarDetalleMaterial.php");
	// 	$materialModel = new AdministrarDetalleMaterial();
	// 	$resultado = $materialModel->prestadoDetalleMaterial();
	// 	echo json_encode($resultado);
	// }

	// function devueltoDetalleMaterial(){
	// 	require_once("../Model/AdministrarDetalleMaterial.php");
	// 	$materialModel = new AdministrarDetalleMaterial();
	// 	$resultado = $materialModel->devueltoDetalleMaterial();
	// 	echo json_encode($resultado);
	// }
	function listFiltroDetalleMaterial(){
		require_once("../Model/AdministrarDetalleMaterial.php");
		$materialModel = new AdministrarDetalleMaterial();
		$type = $_GET["type"];
		$idDeMaterial = $_REQUEST["idMaterial"];
		$resultado = $materialModel->showListDetalleMaterial($type,$idDeMaterial);
		echo json_encode($resultado);
	}



?>