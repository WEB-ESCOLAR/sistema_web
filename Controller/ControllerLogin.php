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

	function updateStateUser(Usuario $usuario){
		require_once("../Model/AdministrarUsuario.php");
		$outputManagment = new AdministrarUsuario();
		$outputManagment->updateState($usuario->idUser,$usuario->estado);
	}

	function login(){
		require_once("../Model/AdministrarUsuario.php");
		require_once("../Model/Usuario.php");
		//date_default_timezone_set('America/Lima');
		$outpurResponse = new AdministrarUsuario();
		$email = $_REQUEST["email"];
		$password = $_REQUEST["password"];
		$data = $outpurResponse->loginUser($email);
		$usuario = new Usuario($data["idUser"],$data["firstName"],$data["lastName"],$data["email"],$data["password"],$data["rol"]);
		if($data){
			if($usuario->desencriptarContraseña($password)){

				 $usuario->actualizarEstadoDeSesion(1);
			     updateStateUser($usuario);
				 almacenarSesion($usuario);
			     echo json_encode(1);
			}else{
				echo json_encode("*La contraseña ingresada es erronea");
			}
		}else{
			echo json_encode("*El correo Ingresado no coincide");
		}


	}

	function logoutUser(){
		require_once("../Model/Usuario.php");
		session_start();
		$idUser = $_SESSION["id"];
		$nombre = $_SESSION["nombre"];
		$rol = $_SESSION["rol"];
		$usuario = new Usuario($idUser,$nombre,null,null,null,$rol);
		$usuario->actualizarEstadoDeSesion(2);
		updateStateUser($usuario);
		session_destroy();
	}

function almacenarSesion(Usuario $usuario){
	session_start();
	$_SESSION["rol"]=$usuario->rol;
	$_SESSION["id"]=$usuario->idUser;
	$_SESSION["nombre"]=$usuario->firstName;
}


 ?>
