<?php 

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "MostrarUltimoPagoApafa":
			ultimePaymentApafa();
			break;
		case "MostrarUsuario":
			fetchAllUsuario();
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



?>