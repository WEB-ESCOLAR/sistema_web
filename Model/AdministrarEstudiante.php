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

	}


 ?>