<?php

	require_once "AdministradorModelo.php";
	class AdministrarEstudiante extends AdministrarModelo{

		function listAllApoderados(){ //obtener registros de la db.
			$sql="SELECT firstName,lastName,DNI,phone,state from apoderado a left join pagoapafa p on p.idApoderado=a.DNI;";
			$respuestaApoderado = $this->consulta($sql);
			while($filas = $respuestaApoderado->fetch(PDO::FETCH_ASSOC)) {
				$apoderado[]=$filas;
			}
			return $apoderado;
		}
		function listaEstudiantes(){ //obtener registros de la db.
			$sql="SELECT * from estudiante";
			$respuestaConsulta = $this->consulta($sql);
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$alumnos[]=$filas;
			}
			return $alumnos;
		}
		function listaEstudiantesForGradeAndSection($grade,$section){ //obtener registros de la db.
			$sql="SELECT * from estudiante where grado='$grade' and section='$section'";
			$respuestaConsultaSearch = $this->consulta($sql);
			$row = $respuestaConsultaSearch->fetch(PDO::FETCH_ASSOC);
			if(!$row){
				return "not found";
			}else{
				while($filas = $respuestaConsultaSearch->fetch(PDO::FETCH_ASSOC)) {
				$searchAlumnos[]=$filas;
				}
				return $searchAlumnos;
			}
			
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
			$respuestaConsulta->bindParam(":firstName",$apoderado->firstName);
			$respuestaConsulta->bindParam(":lastName",$apoderado->lastName);
			$respuestaConsulta->bindParam(":phone",$apoderado->telefono);
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
		function Create(Apoderado $apoderado,Estudiante $estudiante,PagoApafa $pagoApafa){
			$query="INSERT INTO apoderado(DNI,firstName,lastName,phone) values(?,?,?,?)";
			$response = $this->getConexion()->prepare($query);
			$response->bindParam(1,$apoderado->DniApoderado);
			$response->bindParam(2,$apoderado->nombreApoderado);
			$response->bindParam(3,$apoderado->apellidoApoderado);
			$response->bindParam(4,$apoderado->telefonoApoderado);
			$response->execute();	
			if($response){
				$sql2="INSERT INTO estudiante (dni,firstName,LastName,grado,section,idUsuario,idApoderado) values (?,?,?,?,?,?,?)";
				$response2 = $this->getConexion()->prepare($sql2);
				$response2->bindParam(1,$estudiante->DniEstudiante);
				$response2->bindParam(2,$estudiante->nombreEstudiante);
				$response2->bindParam(3,$estudiante->apellidoEstudiante);
				$response2->bindParam(4,$estudiante->gradoEstudiante);
				$response2->bindParam(5,$estudiante->seccionEstudiante);
				$response2->bindParam(6,$estudiante->idUsuario);
				$response2->bindParam(7,$estudiante->DniApoderado);
				$response2->execute();
				if($response2){
				$sql3="INSERT INTO pagoapafa (state,idApoderado) values (?,?)";
				$response3= $this->getConexion()->prepare($sql3);
				$response3->bindParam(1,$pagoApafa->estadoPagoApafa);
				$response3->bindParam(2,$pagoApafa->DniApoderado);
				return $response3->execute();	}
		}
		}
		//END CREATE ESTUDIANTE
		 function PagoApafa($fecha,$id){
			//$fechaactual=date('d-m-y');
			$sql="UPDATE pagoapafa set state=1, fechapago=? where idApoderado=?";
			$data=$this->getConexion()->prepare($sql);
      		$data->bindParam(1,$fecha);
			$data->bindParam(2,$id);

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

		function updateAlumno(estudiante $estudiante){
			$sql="UPDATE estudiante SET firstName=?,LastName=?,grado=?,section=? WHERE dni=?";
			$response=$this->getConexion()->prepare($sql);
			$response->bindParam(1,$estudiante->nombreEstudiante);
			$response->bindParam(2,$estudiante->apellidoEstudiante);
			$response->bindParam(3,$estudiante->gradoEstudiante);
			$response->bindParam(4,$estudiante->seccionEstudiante);
			$response->bindParam(5,$estudiante->DniEstudiante);
			$response->execute();
		}
		//END UPDATE ESTUDIANTE 
	}
		


?>
