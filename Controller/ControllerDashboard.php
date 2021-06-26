<?php

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "MostrarUltimoPagoApafa":
			ultimePaymentApafa();
			break;
		case "MostrarUsuario":
			fetchAllUsuario();
			break;
		case "MostrarNumeroDeSyP":
			totalNumberSandP();
			break;
		case "MostrarNumeroDeMaterial":
			totalNumberMaterial();
			break;
		case "MostrarTotalRegistrosPorNombreyTipo":
			totalRegisterforNameAndType();
			break;
		case "MostrarTotalPagosApafaPorMes";
			totalpayApafaformonth();
			break;
		case "MostrarTotalPrestadosDevueltos":
			totalPrestadosDevueltosPorMeses();
		break;
		default:
			echo 'error de seleccion';
			break;
	}


	function ultimePaymentApafa(){
		require_once("../Model/AdministradorDashboard.php");
		$lastpayModel = new AdministrarDashboard();
		$resultado = $lastpayModel->showLastpay();
		echo json_encode($resultado);
	}

	function fetchAllUsuario(){
		require_once("../Model/AdministradorDashboard.php");
		$usuarioModel = new AdministrarDashboard();
		$resultado = $usuarioModel->showUsers();
		echo json_encode($resultado);
	}

	function totalNumberSandP(){
		require_once("../Model/AdministradorDashboard.php");
		$totalSPModel = new AdministrarDashboard();
		$resultado = $totalSPModel->totalNumberStudentsParents();
		echo json_encode($resultado);
	}

	function totalNumberMaterial(){
		require_once("../Model/AdministradorDashboard.php");
		$totalMaterialModel = new AdministrarDashboard();
		$resultado = $totalMaterialModel->totalNumberRegisterMaterial();
		echo json_encode($resultado);
	}

	function totalRegisterforNameAndType(){
		require_once("../Model/AdministradorDashboard.php");
		$totalRegisterModel = new AdministrarDashboard();
		$resultado = $totalRegisterModel->totalMaterialRegisterforNameAndType();
		echo json_encode($resultado);
	}

	function totalpayApafaformonth(){
		require_once("../Model/AdministradorDashboard.php");
		$totalMaterialModelforMonth = new AdministrarDashboard();
		$resultado = $totalMaterialModelforMonth->payApafaformonth();
		echo json_encode($resultado);
	}

	function totalPrestadosDevueltosPorMeses(){
		require_once("../Model/AdministradorDashboard.php");
		$totalPrestadosDevueltosPorMeses = new AdministrarDashboard();
		$resultado = $totalPrestadosDevueltosPorMeses->cantidadPrestadosDevueltos();
		echo json_encode($resultado);
	}


?>
