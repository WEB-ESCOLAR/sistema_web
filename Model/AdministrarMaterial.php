<?php
	require_once "AdministradorModelo.php";
	class AdministrarMaterial extends AdministrarModelo{

		// private $table="material";

		function listAll(){ //obtener registros de la db.
			$sql="SELECT * from material";
			$respuestaConsulta = $this->consulta($sql);
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$materiales[]=$filas;
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

	}

 ?>
