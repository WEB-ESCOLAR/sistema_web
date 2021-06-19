<?php 

	session_start();
	require_once("layouts/Navbar.php");
	if(!isset($_SESSION["rol"])){
		require_once("auth/login.php");
	}else{	
		 if(!isset($_GET["view"])){
     		 header("Location:Home");
  		}
  		else{
  			 $modules= array("Home","Inicio","GestionDeMateriales","Alumnos","Apoderados","AdministrarMateriales","Configuracion");
  			 $url = $_SERVER['REQUEST_URI'];
			   $searchModule = explode("/",$url)[2];
  			if(in_array($searchModule,$modules)){
  				require_once 'Screens/Home.php';
  			}else{
  				require_once 'Screens/NotFound.php';
  			}
  			
  		}
		
	}

	require_once("layouts/footer.php");
 ?>


