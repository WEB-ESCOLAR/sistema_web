<?php
	require_once "AdministradorModelo.php";
	require_once "Material.php";
	class AdministrarMaterial extends AdministrarModelo{

		// private $table="material";
		function materialState($id,$state){ 
			$sql="SELECT count(idDetalleMaterial) from detallematerial where status=? and idMaterial=?";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$state);
			$response->bindParam(2,$id);
			$response->execute();
			return $response->fetchColumn();
		}

		function listAll(){ //obtener registros de la db.
			$sql="SELECT * from material";
			$respuestaConsulta = $this->consulta($sql);
			$materiales=[];
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
			 $material = new Material(
			$filas["idMaterial"],
			$filas["curse"],
			$filas["tipoMaterial"],
			$filas["grade"],
			$this->materialState($filas["idMaterial"],"DISPONIBLE"), 
			$this->materialState($filas["idMaterial"],"OCUPADO"),
			$filas["ReceptionDate"],
			$filas["nameMaterial"],
			$filas["amount"]
			);
			array_push($materiales,$material);
			}
			return $materiales;
		}

		function Create(Material $material){
			$sql="INSERT INTO material(curse,grade,ReceptionDate,tipoMaterial,nameMaterial,amount) values(?,?,?,?,?,?)";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$material->nombreCurso);
			$response->bindParam(2,$material->grado);
			$response->bindParam(3,$material->fechaRecepcion);
			$response->bindParam(4,$material->tipoMaterial);
			$response->bindParam(5,$material->nombreMaterial);
			$response->bindParam(6,$material->cantidad);
			$response->execute();
		}

		// function CreateDetalleMaterial(){
		// 	$sql="INSERT INTO detallematerial ";
		// }
		function Delete($id){
			$sql="DELETE FROM material where idMaterial=?";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$id);
			$response->execute();
		}

		function listDetalleMaterial(){ //obtener registros de la db.
			$sql="SELECT * from detallematerial where idMaterial=10";
			$respuestaConsulta = $this->consulta($sql);
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$materiales[]=$filas;
			}
			return $materiales;
		}


		function buscarEstudiante($DNI){//BUSCAR ESTUDIANTE PARA PRESTAR
			$sql="select idEstudiante, firstName, LastName, grado, section from estudiante where dni=?";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$DNI);
			$response->execute();
			$result = $response->fetch(PDO::FETCH_ASSOC);
			return $result;
		}

		function prestarMaterial($idEstu, $idMate){
			$sql="CALL prestarMateriales (?, ?)";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$idEstu);
			$response->bindParam(2,$idMate);
			$response->execute();
		}

		function devolverMaterial($idDetMate, $fecha,$motivo){
			$eliminarPrestamo="delete from prestamo where idDetalleMaterial= ?";
			$actualizarEstado="update detallematerial set status = 1 where idDetalleMaterial= ?";
			$registrarDevolucion="insert into detallematerialdevuelto(idDetalle, Datetime, motivo) values(?,?,?)";
			$responseEliminar = $this->getConexion()->prepare($eliminarPrestamo);
			$responseActualizar = $this->getConexion()->prepare($actualizarEstado);
			$responseRegistrar = $this->getConexion()->prepare($registrarDevolucion);
			$responseEliminar->bindParam(1,$idDetMate);
			$responseActualizar->bindParam(1,$idDetMate);
			$responseRegistrar->bindParam(1,$idDetMate);
			$responseRegistrar->bindParam(2,$fecha);
			$responseRegistrar->bindParam(3,$motivo);
			$responseEliminar->execute();
			$responseActualizar->execute();
			$responseRegistrar->execute();
		}

		function verMotivo($idDevolucion){
			$sql="select motivo from detallematerialdevuelto where idDevolucion=?";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$idDevolucion);
			$response->execute();
			$result = $response->fetch(PDO::FETCH_ASSOC);
			return $result;
		}

		function agregarDetalle($cantidad){

			for ($i=0; $i < $cantidad ; $i++) {
				$sql="insert into detallematerial(idMaterial, status) values (10, 1)";
				$response = $this->getConexion()->prepare($sql);
				$response->execute();
			}
		}

		function deleteDetalleMaterial($id){
			$sql="DELETE FROM detallematerial where idDetalleEliminar=?";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$id);
			$response->execute();
		}
		function listDetalleMaterial(){
			$sql="SELECT * from detallematerial where idMaterial=10";
     	$respuestaConsulta=$this->consulta($sql);


		function listDetalleMaterial(){
			$sql="SELECT * from detallematerial where idMaterial=10";
			$respuestaConsulta=$this->consulta($sql);
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)){
				$materiales[]=$filas;
			}
				return $materiales;

		}
		/////AGREGAR DETALLE MATERIAL////
		function AgregarDetalle($cantidad){
			for ($i=0; $i < $cantidad ; $i++) {
				$sql="INSERT INTO detallematerial (idMaterial,status) values (10,1)";
				$response = $this->getConexion()->prepare($sql);
				$response->execute();
			}

			}
		/////ELIMINAR DETALLE MATERIAL///////
			function DeleteDetalle($id){
				$sql="DELETE FROM detallematerial where idDetalleMaterial=?";
				$response = $this->getConexion()->prepare($sql);
				$response->bindParam(1,$id);
				$response->execute();
			}

	}

 ?>
