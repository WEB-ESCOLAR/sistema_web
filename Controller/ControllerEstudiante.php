<?php
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "MostrarApoderado":
			fetchAllApoderado();
			break;
		case "MostrarEstudiante":
			fetchAllEstudiante();
			break;
		case "DetalleApoderado":
			detailApoderado();
			break;
		case "UpdateApoderado":
			updateApoderado();
			break;
		case "EliminarEstudiante":
			deleteEstudiante();
			break;
		case "PagoApafa":
			updatePagoApafa();
			break;
		case "BuscarGradoAndSection":
			fetchAllSectionAndGrade();
			break;
		default:
			echo 'error de seleccion';
			break;
	}


	
	
	function fetchAllApoderado(){
		require_once("../Model/AdministrarEstudiante.php");
		$administrarEstudiante = new AdministrarEstudiante();
		$apoderados = $administrarEstudiante->listAllApoderados();
		echo json_encode($apoderados); 
	}
	function detailApoderado(){
		require_once("../Model/AdministrarEstudiante.php");
		$administrarEstudiante = new AdministrarEstudiante();
		$id = $_GET["id"];
		$data = $administrarEstudiante->readApoderado($id);
		echo json_encode($data); 
	}
	function updateApoderado(){
		require_once("../Model/Apoderado.php");
		require_once("../Model/AdministrarEstudiante.php");
		$administrarEstudiante = new AdministrarEstudiante();
		$dni = $_POST["dni"];
		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$telefono= $_POST["telefono"];
		$apoderado = new Apoderado($dni,$nombre,$apellido,$telefono);
	 	$affect = $administrarEstudiante->updateApoderados($apoderado);
	 	// UUID()
		// echo json_encode(var_dump($apoderado));
		// $count=$re->rowCount();
		// echo json_encode($affect);
	}


	function conexionDatabase(){
		require_once("../Model/AdministradorModelo.php");
		$conexionPrueba = new AdministrarModelo();
		echo json_encode($conexionPrueba->getConexion());
	}

	function fetchAllEstudiante(){
		require_once("../Model/AdministrarEstudiante.php");
		$estudianteModel = new AdministrarEstudiante();
		$resultado = $estudianteModel->listaEstudiantes();
		echo json_encode($resultado);

	}


	// require_once("../Model/Material.php");


	//DELETE ESTUDIANTE
	function deleteEstudiante(){
		require_once("../Model/AdministrarEstudiante.php");
		$estudianteModel = new AdministrarEstudiante();
		$idEstudiante = $_POST["id"];
		$estudianteModel->Delete($idEstudiante);
		echo json_encode("Eliminando");
	}
	//END DELETE ESTUDIANTE
	 function updatePagoApafa(){
	//require_once("../Model/PagoApafa.php");
		require_once("../Model/AdministrarEstudiante.php");
		$pagoapafaModel = new AdministrarEstudiante();
		$id = $_POST["id"];
		$output = $pagoapafaModel->PagoApafa($id);
	}

	function fetchAllSectionAndGrade(){
		require_once("../Model/AdministrarEstudiante.php");
		$section = $_POST["section"];
		$grade = $_POST["grade"];
		$administrarEstudiante = new AdministrarEstudiante();
		$estudiantes = $administrarEstudiante->listaEstudiantesForGradeAndSection($grade,$section);
		echo json_encode($estudiantes); 
	}	

 ?>
