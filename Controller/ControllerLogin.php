<?php

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "Login":
			login();
			break;
		case "Logout":
			logoutUser();
			break;
		case "UpdateUsuario":
			UpdateUsuario();
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
				session_start();
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
		$id = $_SESSION["id"];
		$nombre = $_SESSION["nombre"];
		$apellido = $_SESSION["apellido"];
		$email = $_SESSION["email"];
		$rol = $_SESSION["rol"];
		$usuario = new Usuario($id,$nombre,$apellido,$email,null,null,$rol);
		$usuario->actualizarEstadoDeSesion(2);
		updateStateUser($usuario);
		session_destroy();
	}
	   function UpdateUsuario(){
        require_once("../Model/AdministrarUsuario.php");
        require_once("../Model/Usuario.php");
        $administrarUsuario=new AdministrarUsuario();
        session_start();
		$Usuario = $_SESSION["id"];
        $firstName=$_POST["firstName"];
        $lastName=$_POST["lastName"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $rol = $_SESSION["rol"];
        $encryption=password_hash($password, PASSWORD_BCRYPT);
        $configuracionUsuario=new Usuario(intval($Usuario),$firstName,$lastName,$email,$encryption,$rol);
        almacenarSesion($configuracionUsuario);
        $administrarUsuario->UpdateUsuario($configuracionUsuario);
        echo json_encode($administrarUsuario);
    }

function almacenarSesion(Usuario $usuario){
	$_SESSION["rol"]=$usuario->rol;
	$_SESSION["id"]=$usuario->idUser;
	$_SESSION["nombre"]=$usuario->firstName;
	$_SESSION["apellido"]=$usuario->lastName;
	$_SESSION["email"]=$usuario->email;
}


 ?>
