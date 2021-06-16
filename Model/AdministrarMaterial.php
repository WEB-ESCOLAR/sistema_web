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
			$sql="INSERT INTO material(idMaterial,curse,grade,ReceptionDate,tipoMaterial,nameMaterial,amount) values(?,?,?,?,?,?,?)";
			$response = $this->getConexion()->prepare($sql);
			$response->bindParam(1,$material->id);
			$response->bindParam(2,$material->nombreCurso);
			$response->bindParam(3,$material->grado);
			$response->bindParam(4,$material->fechaRecepcion);
			$response->bindParam(5,$material->tipoMaterial);
			$response->bindParam(6,$material->nombreMaterial);
			$response->bindParam(7,$material->cantidad);
			
			$resultado=$response->execute();
			if($resultado){
				$this->agregarDetalle($material->cantidad, $material->id);
			}
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

		function listDetalleMaterial($idMaterial){ //obtener registros de la db.
			$sql="SELECT * from detallematerial where idMaterial=$idMaterial";
			$respuestaConsulta = $this->consulta($sql);
			$row = $respuestaConsulta->fetch(PDO::FETCH_ASSOC);
			if(!$row){
				return 0;
			}else{
				while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$materiales[]=$filas;
			}
				return $materiales;
			}
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
			$status="DISPONIBLE";
			for ($i=0; $i < $cantidad ; $i++) {
				$sql="insert into detallematerial(idMaterial, status, codigo) values (?,?,?)";
				$response = $this->getConexion()->prepare($sql);
				$response->bindParam(1,$idMaterial);
				$response->bindParam(2,$status);
				$response->bindParam(3,$this->generarCodigo());
				$response->execute();
			}
		}

		function generarCodigo()
		{
		    $codigo = "";
		    //longitud del codigo
		    $longitud=5;
		    //caracteres a ser utilizados
		    $caracteres="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		    //el maximo de caracteres a usar
		    $max=strlen($caracteres)-1;
		    //creamos un for para generar el codigo aleatorio utilizando parametros min y max
		    for($i=0;$i < $longitud;$i++)
		    {
		        $codigo.=$caracteres[rand(0,$max)];
		    }
		    //regresamos codigo como valor
		    return strtoupper($codigo);
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
