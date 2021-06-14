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
		case "AgregarEstudiante":
			agregarEstudiante();
		case "BuscarGradoAndSection":
			fetchAllSectionAndGrade();
			break;
		default:
			echo 'error de seleccion';
			break;
	}


  //$fechaActual = date('d-m-Y');
	//echo $fechaActual




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
		$fecha = date('Y-m-d', time());
		$output = $pagoapafaModel->PagoApafa($fecha,$id);
	}
	//CREATE ESTUDIANTE
	function agregarEstudiante(){
		require_once("../Model/AdministrarEstudiante.php");
		require_once("../Model/Estudiante.php");
		require_once("../Model/Apoderado.php");
		$estudianteModel = new AdministrarEstudiante();
		$DniEstudiante = $_POST["DniEstudiante"];
		$nombreEstudiante = $_POST["nombreEstudiante"];
		$apellidoEstudiante=$_POST["apellidoEstudiante"];
		$gradoEstudiante = $_POST["gradoEstudiante"];
		$seccionEstudiante = $_POST["seccionEstudiante"];
		$DniApoderado = $_POST["DniApoderado"];
		$nombreApoderado = $_POST["nombreApoderado"];
		$apellidoApoderado = $_POST["apellidoApoderado"];
		$telefonoApoderado = $_POST["telefonoApoderado"];
		$estudiante = new Estudiante(null,$DniEstudiante,$nombreEstudiante,$apellidoEstudiante,$gradoEstudiante,$seccionEstudiante,intval("1"),"10555153");
		$apoderado=new Apoderado($DniApoderado,$nombreApoderado,$apellidoApoderado,$telefonoApoderado);
		$output=$estudianteModel->Create($apoderado,$estudiante);
		echo json_encode($output);
		//echo json_encode(var_dump($estudiante));
	}
	//END CREATE ESTUDIANTE

	function fetchAllSectionAndGrade(){
		require_once("../Model/AdministrarEstudiante.php");
		$section = $_POST["section"];
		$grade = $_POST["grade"];
		$administrarEstudiante = new AdministrarEstudiante();
		$estudiantes = $administrarEstudiante->listaEstudiantesForGradeAndSection($grade,$section);
		echo json_encode($estudiantes); 
	}	

 ?>
