<?php
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	switch($action){
		case "MostrarApoderado":
			fetchAllApoderado();
			break;
		case "SearchDniApoderado":
				searchDniApoderado();
				break;
		case "MostrarEstudiante":
			fetchAllEstudiante();
			break;
		case "DetalleApoderado":
			detailApoderado();
			break;
		case "MostrarTotalEstudiantesPorGradoYSeccion":
			totalForSectionAndGrade();
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
			break;
		case "BuscarGradoAndSection":
			fetchAllSectionAndGrade();
			break;
		case "DetalleEstudiante":
			detailEstudiante();
			break;
		case "UpdateEstudiante":
			updateEstudiante();
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
	function searchDniApoderado(){
		require_once("../Model/AdministrarEstudiante.php");
		$administrarEstudiante = new AdministrarEstudiante();
		$dni = $_GET["dni"];
		$data = $administrarEstudiante->searchDniApoderado($dni);
		echo json_encode($data);
	}


	function updateApoderado(){
		require_once("../Model/Apoderado.php");
		require_once("../Model/AdministrarEstudiante.php");
		$administrarEstudiante = new AdministrarEstudiante();
		$dni = $_REQUEST["dni"];
		$nombre = $_REQUEST["nombre"];
		$apellido = $_REQUEST["apellido"];
		$telefono= $_REQUEST["telefono"];
		$apoderado = new Apoderado($dni,$nombre,$apellido,$telefono);
	 	$affect = $administrarEstudiante->updateApoderados($apoderado);
	}


	function conexionDatabase(){
		require_once("../Model/AdministradorModelo.php");
		$conexionPrueba = new AdministrarModelo();
		echo json_encode($conexionPrueba->getConexion());
	}

	function fetchAllEstudiante(){
		require_once("../Model/AdministrarEstudiante.php");
		$estudianteModel = new AdministrarEstudiante();
		$grade = $_GET["grade"];
		$section = $_GET["section"];
		if(empty($grade) && empty($section)){
			// echo json_encode(1);
			$resultado = $estudianteModel->listaEstudiantes(null,null);
		}else{
			$resultado = $estudianteModel->listaEstudiantes($grade,$section);
		}
		echo json_encode($resultado);
	}
	function totalForSectionAndGrade(){
		require_once("../Model/AdministrarEstudiante.php");
		$section = $_GET["section"];
		$grade = $_GET["grade"];
		$totalEstudiante = new AdministrarEstudiante();
		$students = $totalEstudiante->totalStudentsForGradeAndSection($grade,$section);
		echo json_encode($students); 
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
			require_once("../Model/pagoApafa.php");
			$pagoapafaModel = new AdministrarEstudiante();
			$id = $_POST["id"];
			$pagoApafa = new PagoApafa($id,null);
			$pagoApafa->actualizarEstadoPagoApafa(1);
			$output = $pagoapafaModel->PagoApafa($pagoApafa);
			echo json_encode($output);
		}
	
	
		//CREATE ESTUDIANTE
		function agregarEstudiante(){
			require_once("../Model/AdministrarEstudiante.php");
			require_once("../Model/Estudiante.php");
			require_once("../Model/Apoderado.php");
			require_once("../Model/pagoApafa.php");
			session_start();
			$Usuario = $_SESSION["id"];
			$estudianteModel = new AdministrarEstudiante();
			$DNI = $_POST["DNI"];
			$Nombre = $_POST["Nombre"];
			$Apellido=$_POST["Apellido"];
			$Grado = $_POST["Grado"];
			$Seccion = $_POST["Seccion"];
			$dni = $_POST["dni"];
			$nombre = $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$celular = $_POST["celular"];
			$apoderadoExist = $_POST["apoderadoExist"];
			$apoderado=new Apoderado($dni,$nombre,$apellido,$celular);
			$estudiante = new Estudiante(null,$DNI,$Nombre,$Apellido,$Grado,$Seccion,intval($Usuario),$apoderado);
			$pagoApafa= new PagoApafa(null,$apoderado);
			$pagoApafa->actualizarEstadoPagoApafa(2);
			$output=$estudianteModel->Create($estudiante,$pagoApafa,$apoderadoExist);

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
	//UPDATE ESTUDIANTE
	function detailEstudiante(){
		require_once("../Model/AdministrarEstudiante.php");
		$estudianteModel= new AdministrarEstudiante();
		$id = $_GET["id"];
		$data = $estudianteModel->readEstudiante($id);
		echo json_encode($data);
	}

	function updateEstudiante(){
		require_once("../Model/Estudiante.php");
		require_once("../Model/AdministrarEstudiante.php");
		session_start();
		$Usuario = $_SESSION["id"];
		$administrarEstudiante = new AdministrarEstudiante();
		$idEstudiante= $_POST["idEstudiante"];
		$DNI = $_POST["DNI"];
		$Nombre = $_POST["Nombre"];
		$Apellido=$_POST["Apellido"];
		$Grado = $_POST["Grado"];
		$Seccion = $_POST["Seccion"];
		$apoderado=$_POST["apoderado"];
		$estudiante = new Estudiante($idEstudiante,$DNI,$Nombre,$Apellido,$Grado,$Seccion,intval($Usuario),$apoderado);
	 	$affect = $administrarEstudiante->updateAlumno($estudiante);
		// echo json_decode(var_dump($estudiante));
	}
	//END UPDATE ESTUDIANTE

 ?>
