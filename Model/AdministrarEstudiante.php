<?php

	require_once "AdministradorModelo.php";
	require_once "Apoderado.php";
	class AdministrarEstudiante extends AdministrarModelo{

		function listAllApoderados(){ //obtener registros de la db.
			$sql="SELECT firstName,lastName,DNI,phone,state from apoderado a left join pagoapafa p on p.idApoderado=a.DNI;";
			$respuestaApoderado = $this->consulta($sql);
			while($filas = $respuestaApoderado->fetch(PDO::FETCH_ASSOC)) {
				$apoderado[]=$filas;
			}
			return $apoderado;
		}
		function listaEstudiantes($grade,$section){ //obtener registros de la db.
			if ($grade==null && $section==null){
				$sql="SELECT * from estudiante";
			}else{
				$sql="SELECT * from estudiante where grado= '$grade' and section='$section'";
			}
			$respuestaConsulta = $this->consulta($sql);
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$alumnos[]=$filas;
			}
			return $alumnos;
		}
		function searchDniApoderado($dni){
			$sql="SELECT * from apoderado where DNI=?";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$dni);
			$response->execute();
			$result = $response->fetch(PDO::FETCH_ASSOC);
			return $result;
		}


		function totalStudentsForGradeAndSection($grade,$section){
			$sql="SELECT COUNT(idEstudiante) as 'totalForGradeandSection' from estudiante where grado='$grade' and section='$section'";
			$respuestaConsultaSearch = $this->consulta($sql);
			$respuestaConsultaSearch->execute();
			return $respuestaConsultaSearch->fetchColumn();
		}


		function totalEstudiantes(){
			$sql="SELECT count(*) from estudiante";
			$response = $this->getConexion()->prepare($sql);
			$response->execute();
			$result = $response->fetch(PDO::FETCH_ASSOC);
			return $result;
		}


		function readApoderado($id){
			$sql="SELECT * from apoderado where DNI=?";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$id);
			$response->execute();
			$result = $response->fetch(PDO::FETCH_ASSOC);
			return $result;
		}

		function updateApoderados(Apoderado $apoderado){
			$sql="UPDATE apoderado set firstName=:firstName,lastName=:lastName,phone=:phone where DNI=:dni";
			$respuestaConsulta = $this->getConexion()->prepare($sql);
			$respuestaConsulta->bindParam(":firstName",$apoderado->nombre);
			$respuestaConsulta->bindParam(":lastName",$apoderado->apellido);
			$respuestaConsulta->bindParam(":phone",$apoderado->celular);
			$respuestaConsulta->bindParam(":dni",$apoderado->dni);
			$respuestaConsulta->execute();
		}
		// DELETE ESTUDIANTE
		function Delete($id){
			$sql="DELETE FROM estudiante where idEstudiante=?";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$id);
			$response->execute();
		}
		//END DELETE ESTUDIANTE
		// CREATE ESTUDIANTE
		function Create(Estudiante $estudiante,pagoApafa $pagoApafa,$apoderadoExist){
			if($apoderadoExist == 1){
				$this->createAlumno($estudiante);
			}else{
				if($this->createApoderado($estudiante)){
					if($this->createAlumno($estudiante)){
						$this->createPagoApafa($estudiante,$pagoApafa);
					}
				}
			}
		}

		function createAlumno(Estudiante $estudiante){
				$sql2="INSERT INTO estudiante (dni,firstName,LastName,grado,section,idUsuario,idApoderado) values (?,?,?,?,?,?,?)";
				$response2 = $this->getConexion()->prepare($sql2);
				$response2->bindParam(1,$estudiante->DNI);
				$response2->bindParam(2,$estudiante->Nombre);
				$response2->bindParam(3,$estudiante->Apellido);
				$response2->bindParam(4,$estudiante->Grado);
				$response2->bindParam(5,$estudiante->Seccion);
				$response2->bindParam(6,$estudiante->Usuario);
				$response2->bindParam(7,$estudiante->apoderado->dni);
				return $response2->execute();
		}
		function createApoderado(Estudiante $estudiante){
			$query="INSERT INTO apoderado(DNI,firstName,lastName,phone) values(?,?,?,?)";
			$response = $this->getConexion()->prepare($query);
			$response->bindParam(1,$estudiante->apoderado->dni);
			$response->bindParam(2,$estudiante->apoderado->nombre);
			$response->bindParam(3,$estudiante->apoderado->apellido);
			$response->bindParam(4,$estudiante->apoderado->celular);
			return $response->execute();
		}
		function createPagoApafa(Estudiante $estudiante,pagoApafa $pagoApafa){
			$sql3="INSERT INTO pagoapafa (state,idApoderado) values (?,?)";
			$response3= $this->getConexion()->prepare($sql3);
			$response3->bindParam(1,$pagoApafa->estado);
			$response3->bindParam(2,$estudiante->apoderado->dni);
			return $response3->execute();
		}
		//END CREATE ESTUDIANTE
		function PagoApafa(PagoApafa $pagoApafa){
			//$fechaactual=date('d-m-y');
			$sql="UPDATE pagoapafa set state='PAGO',fechapago=? where idApoderado=?";
			$data=$this->getConexion()->prepare($sql);
      		$data->bindParam(1,$pagoApafa->fechaPago);
			$data->bindParam(2,$pagoApafa->codigoApafa);
			$data->execute();
   		}
		//UPDATE ESTUDIANTE
		function readEstudiante($id){
			$sql="SELECT * from estudiante where idEstudiante=?";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$id);
			$response->execute();
			$result = $response->fetch(PDO::FETCH_ASSOC);
			return $result;
		}


		function updateAlumno(Estudiante $estudiante){
			$sql="UPDATE estudiante SET firstName=:firstName,LastName=:LastName,grado=:grado,section=:section WHERE dni=:dni";
			$response=$this->getConexion()->prepare($sql);
			$response->bindParam(":firstName",$estudiante->Nombre);
			$response->bindParam(":LastName",$estudiante->Apellido);
			$response->bindParam(":grado",$estudiante->Grado);
			$response->bindParam(":section",$estudiante->Seccion);
			$response->bindParam(":dni",$estudiante->DNI);
			$response->execute();
		}
		//END UPDATE ESTUDIANTE

		function generarBoleta($dni){
			$sql="SELECT * FROM apoderado where DNI = ?";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$dni);
			$response->execute();
			$result = $response->fetch(PDO::FETCH_ASSOC);
			return $result;
		}

	}



?>
