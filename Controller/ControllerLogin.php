<?php 

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "Login":
			login();
			break;
		case "Logout":
			logoutUser();
			break;
		default:
			echo 'error de seleccion';
			break;
	}

	
	
	// require_once("../Model/Material.php");

	function updateStateUser($id,$state){
		require_once("../Model/AdministrarUsuario.php");
		$outputManagment = new AdministrarUsuario();
		$outputManagment->updateState($id,$state);
	}

	function login(){
		require_once("../Model/AdministrarUsuario.php");
		$outpurResponse = new AdministrarUsuario();
		$email = $_REQUEST["email"];
		$password = $_REQUEST["password"];
		$data = $outpurResponse->loginUser($email,$password);
		if($data){
			if(password_verify($password, $data["password"])){
				 session_start();
			     $_SESSION["rol"]=$data["rol"];
			     $_SESSION["id"]=$data["idUser"];
			     $_SESSION["nombre"]=$data["firstName"];
			     updateStateUser($data["idUser"],1);
			     echo json_encode(1);
			}else{
				echo json_encode("*La contraseña ingresada es erronea");
			}
		}else{
			echo json_encode("*El correo Ingresado no coincide");
		}
		

	}
	
	function logoutUser(){
		 session_start();
		$idUser = $_SESSION["id"];
		updateStateUser($idUser,2);
		session_destroy();
	}




 ?>