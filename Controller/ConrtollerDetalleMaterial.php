<?php 

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "-----":
			break;
		default:
			echo 'error de seleccion';
			break;
	}

	function disponibleDetalleMaterial(){
		require_once("../Model/AdministrarDetalleMaterial.php");
		$materialModel = new AdministrarDetalleMaterial();
		$estado = $_GET["estado"];
		$resultado = $materialModel->disponibleDetalleMaterial($estado);
		echo json_encode($resultado);
	}

	function prestadoDetalleMaterial(){
		require_once("../Model/AdministrarDetalleMaterial.php");
		$materialModel = new AdministrarDetalleMaterial();
		$resultado = $materialModel->prestadoDetalleMaterial();
		echo json_encode($resultado);
	}

	function devueltoDetalleMaterial(){
		require_once("../Model/AdministrarDetalleMaterial.php");
		$materialModel = new AdministrarDetalleMaterial();
		$resultado = $materialModel->devueltoDetalleMaterial();
		echo json_encode($resultado);
	}



?>