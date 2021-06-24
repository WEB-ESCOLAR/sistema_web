<?php 

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "filtrarDetalleMaterial":
			listFiltroDetalleMaterial();
			break;
		case "reporteView":
			generarReporte();
			break;
		default:
			echo 'error de seleccion';
			break;
	}

	//asda
	function listFiltroDetalleMaterial(){
		require_once("../Model/AdministrarDetalleMaterial.php");
		$materialModel = new AdministrarDetalleMaterial();
		$type = $_GET["type"];
		$idDeMaterial = $_REQUEST["idMaterial"];
		$resultado = $materialModel->showListDetalleMaterial($type,$idDeMaterial);
		echo json_encode($resultado);
	}

	function generarReporte(){
		require_once("../Model/AdministrarDetalleMaterial.php");
		// require_once("../util/reporteDañados.php");
		$materialModel = new AdministrarDetalleMaterial();
		$type = $_GET["type"];
		$idDeMaterial = $_REQUEST["idMaterial"];
		$resultado = $materialModel->showGenerarReporte($type,$idDeMaterial);
		echo json_encode($resultado);
	}



?>