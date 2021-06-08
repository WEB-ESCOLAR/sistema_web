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
		function Create(Estudiante $estudiante, Apoderado $apoderado){
			$sql="INSERT INTO estudiante(firstName,LastName,dni,grado,section,idUsuario,idApoderado) values(?,?,?,?,?,?,?)";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$estudiante->nommbreEstudiante);
			$response->bindParam(2,$estudiante->ApellidoEstudiante);
			$response->bindParam(3,$estudiante->DniEstudiante);
			$response->bindParam(4,$estudiante->gradoEstudiante);
			$response->bindParam(5,$estudiante->seccionEstudiante);
			$response->bindParam(6,$estudiante->idUsuario);
			$response->bindParam(6,$estudiante->idApoderado);
			$response->execute();
			$query="INSERT INTO apoderado(DNI,firstName,lastName,phone) values(?,?,?,?)";
			$response->bindParam(1,$apoderado->DniApoderado);
			$response->bindParam(2,$apoderado->nombreApoderado);
			$response->bindParam(3,$apoderado->apellidoApoderado);
			$response->bindParam(4,$apoderado->telefonoApoderado);
			$response->execute();
		}
		//END CREATE ESTUDIANTE
		 function PagoApafa($id){
			$sql="UPDATE pagoapafa set state=1 where idApoderado=?";
			$data=$this->getConexion()->prepare($sql);
			$data->bindParam(1,$id);
			$data->execute();
   		}
	}
		


?>
