<?php 

require_once "AdministradorModelo.php";
	class AdministrarMaterial extends AdministrarModelo{


		function listAllApoderados(){ //obtener registros de la db.
			$sql="SELECT * from material";
			$respuestaConsulta = $this->consulta($sql);
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$productos[]=$filas;
			}
			return $productos;
		}

	}


 ?>