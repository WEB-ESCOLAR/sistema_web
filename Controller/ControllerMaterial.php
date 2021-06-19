<?php

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "Mostrar":
			fetchAll();
			break;
		case "Conexion":
			conexionDatabase();
			break;
		case "Agregar":
			agregarMaterial();
			break;
		case "Eliminar":
			deleteMaterial();
			break;
		case "DetalleMaterial":
				fetchAllDetalleMaterial();
				break;
		case "buscarAlumno":
				buscar();
				break;
		case "prestarMaterial":
				prestar();
				break;
		case "Devolver":
				devolucion();
				break;
		case "verMotivo":
				verMotivo();
				break;
		case "AgregarDetalleCantidad":
			  AddDetalle();
			break;
		case "EliminarDetalleMaterial":
			deleteDetalleMaterial();
			break;
		default:
			echo 'error de seleccion';
			break;
	}



	// require_once("../Model/Material.php");

	function conexionDatabase(){
		require_once("../Model/AdministradorModelo.php");
		$conexionPrueba = new AdministrarModelo();
		echo json_encode($conexionPrueba->getConexion());
	}

	function fetchAll(){
		require_once("../Model/AdministrarMaterial.php");
		$materialModel = new AdministrarMaterial();
		$resultado = $materialModel->listAll();
		echo json_encode($resultado);
	}

	function agregarMaterial(){
		require_once("../Model/AdministrarMaterial.php");
		require_once("../Model/Material.php");
		$materialModel = new AdministrarMaterial();
		$id = mt_rand(100000, 999999);
		$curso = $_POST["curso"];
		$grado=$_POST["grado"];
		$fechaRecepcion = $_POST["fechaRecepcion"];
		$cantidad = $_POST["cantidad"];
		$tipoMaterial = $_POST["tipoMaterial"];
		$nombreMaterial = $_POST["nombreMaterial"];
		$material = new Material($id,$curso,$tipoMaterial,$grado,null,null,$fechaRecepcion,$nombreMaterial,$cantidad);
		$materialModel->Create($material);
	}

	function deleteMaterial(){
		require_once("../Model/AdministrarMaterial.php");
		$materialModel = new AdministrarMaterial();
		$idMaterial = $_POST["id"];
		$materialModel->Delete($idMaterial);
		echo json_encode("Eliminando");
	}

	function fetchAllDetalleMaterial(){
		require_once("../Model/AdministrarMaterial.php");
		$materialModel = new AdministrarMaterial();
		$idMaterial = $_GET["id"];
		$resultado = $materialModel->listDetalleMaterial($idMaterial);
		echo json_encode($resultado);
	}

	function buscar(){
		require_once("../Model/AdministrarMaterial.php");
		$materialModel = new AdministrarMaterial();
		$dniEstudiante = $_GET["DNI"];
		$resultado = $materialModel->buscarEstudiante($dniEstudiante);
		echo json_encode($resultado);
		// if($resultado){
		// 	$_GET["nombreEstudiante"]=$resultado["nombreEstudiante"];
		// 	$_GET["apellidoEstudiante"]=$resultado["apellidoEstudiante"];
		// 	$_GET["gradoEstudiante"]=$resultado["gradoEstudiante"];
		// 	$_GET["seccionEstudiante"]=$resultado["seccionEstudiante"];
		//
		// }else{
		// 	echo json_encode("");
		// }

	}

	function prestar(){
		require_once("../Model/AdministrarMaterial.php");
		$materialModel = new AdministrarMaterial();
		$idEstudiante = $_POST["idEstu"];
		$idDetalleMaterial = $_POST["idDetaMate"];
		$materialModel->prestarMaterial($idEstudiante,$idDetalleMaterial);
		echo json_encode("Prestando");
	}

	function devolucion(){
		require_once("../Model/AdministrarMaterial.php");
		$materialModel = new AdministrarMaterial();
		$idDetaMate = $_POST["idDetaMate"];
		$motivo = $_POST["motivo"];
		$fecha=date('Y-m-d h:i:s', time());
		$idPrestamoDevolucion = $_POST["idPrestamoDevolucion"];
		$materialModel->devolverMaterial($fecha,$motivo,$idDetaMate,$idPrestamoDevolucion);
		echo json_encode($materialModel);
	}

	function verMotivo(){
		require_once("../Model/AdministrarMaterial.php");
		$materialModel = new AdministrarMaterial();
		$idDevo = $_GET["idDevo"];
		$resultado=$materialModel->verMotivo($idDevo);
		echo json_encode($resultado);
	}

function agregarDetalleMaterial(){
	require_once("../Model/AdministrarMaterial.php");
	$materialModel = new AdministrarMaterial();
	$cant = $_POST[""];
	$idDetaMaterial= $_POST["idDetaMaterial"];
	$materialModel->agregarDetalle($cant,$idDetaMaterial);
}

function deleteDetaMate(){
	require_once("../Model/AdministrarMaterial.php");
	$materialModel = new AdministrarMaterial();
	$idDetaMaterial = $_POST["id"];
	$materialModel->deleteDetalleMaterial($idDetaMaterial);
	echo json_encode("Eliminando");
}
// function listDetalleMaterial(){
//   require_once("../Model/AdministrarMaterial.php");
//   $materialModel = new AdministrarMaterial();
//   $output=$materialModel->listDetalleMaterial();
//   echo json_encode($output);
// }

//////AGREGAR DETALLE MATERIAL///
function AddDetalle(){
	require_once("../Model/AdministrarMaterial.php");
	$materialModel=new AdministrarMaterial();
	$cant=$_POST["cantidad"];
	$materialModel->AgregarDetalle($cant);

}
////ELIMIANR DETALLE ELIMINAR/////
function deleteDetalleMaterial(){
	require_once("../Model/AdministrarMaterial.php");
	$materialModel = new AdministrarMaterial();
	$idDetaMaterial = $_POST["idDta"];
	$materialModel->DeleteDetalle($idDetaMaterial);
	echo json_encode("Eliminando Detalle");
}
	// function fetchAllDetalleMaterial(){
	// 	require_once("../Model/AdministrarMaterial.php");
	// 	$materialModel = new AdministrarMaterial();
	// 	//$idMaterial = $_POST["id"];
	// 	$output=$materialModel->listDetalleMaterial();
	// 	//$resultado = $materialModel->listDetalleMaterial();
	// 	echo json_encode($output);
	// }

 ?>
