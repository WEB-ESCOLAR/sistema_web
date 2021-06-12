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
