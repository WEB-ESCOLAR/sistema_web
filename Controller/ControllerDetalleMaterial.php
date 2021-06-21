<?php 

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "filtrarDetalleMaterial":
			listFiltroDetalleMaterial();
			break;
		default:
			echo 'error de seleccion';
			break;
	}

	
	function listFiltroDetalleMaterial(){
		require_once("../Model/AdministrarDetalleMaterial.php");
		$materialModel = new AdministrarDetalleMaterial();
		$type = $_GET["type"];
		$idDeMaterial = $_REQUEST["idMaterial"];
		$resultado = $materialModel->showListDetalleMaterial($type,$idDeMaterial);
		echo json_encode($resultado);
	}



?>