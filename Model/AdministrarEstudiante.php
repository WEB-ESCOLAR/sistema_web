<?php

require_once "AdministradorModelo.php";
	class AdministrarEstudiante extends AdministrarModelo{

		function listaEstudiantes(){ //obtener registros de la db.
			$sql="SELECT * from estudiante";
			$respuestaConsulta = $this->consulta($sql);
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$alumnos[]=$filas;
			}
			return $alumnos;
		}

	}


 ?>
