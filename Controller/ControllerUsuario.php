<?php

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "UpdateUsuario":
			UpdateUsuario();
			break;
		default:
			echo 'error de seleccion';
			break;
	}

  //   function UpdateUsuario(){
  //       require_once("../Model/AdministrarUsuario.php");
  //       require_once("../Model/Usuario.php");
  //       $administrarUsuario=new AdministrarUsuario();
  //       session_start();
		// $Usuario = $_SESSION["id"];
  //       $firstName=$_POST["firstName"];
  //       $lastName=$_POST["lastName"];
  //       $email=$_POST["email"];
  //       $password=$_POST["password"];
  //       $rol = $_SESSION["rol"];
  //       $encryption=password_hash($password, PASSWORD_BCRYPT);
  //       $configuracionUsuario=new Usuario(intval($Usuario),$firstName,$lastName,$email,$encryption,$rol);
  //       $administrarUsuario->UpdateUsuario($configuracionUsuario);
  //       echo json_encode($administrarUsuario);
  //   }


 ?>
