<?php 

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "--------":
			break;
		default:
			echo 'error de seleccion';
			break;
	}


// echo "<br>Código aleatorio : ".generarCodigo();



?>