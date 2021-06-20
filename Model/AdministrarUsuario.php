<?php
	require_once "AdministradorModelo.php";
	class AdministrarUsuario extends AdministrarModelo{

		// private $table="material";

		function loginUser($email){ //obtener registros de la db.
			$sql="SELECT * FROM usuario where email=:email";
			$respuestaConsulta = $this->getConexion()->prepare($sql);
			$respuestaConsulta->bindParam(":email",$email);
			$respuestaConsulta->execute();
			$result = $respuestaConsulta->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
		function updateState($id,$status){ //obtener registros de la db.
			//$dateAndHour = date('Y-m-d h:i:s', time());
			$sql="UPDATE usuario set status=:status where idUser=:id";
			$respuestaConsulta = $this->getConexion()->prepare($sql);
			$respuestaConsulta->bindParam(":status",$status);
			//$respuestaConsulta->bindParam(":updated_at",$dateAndHour);
			$respuestaConsulta->bindParam(":id",$id);
			$respuestaConsulta->execute();
		}

	}

 ?>
