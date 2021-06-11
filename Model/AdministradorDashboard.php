<?php 

	require_once "AdministradorModelo.php";
	class AdministrarDashboard extends AdministrarModelo{


   		function showLastpay(){
			$sql="SELECT concat(a.firstName,' ',a.lastName) as apoderado, concat(e.firstName,' ',e.LastName) as estudiante, e.grado, e.section, pa.fechaPago from pagoapafa pa INNER JOIN apoderado a on pa.idApoderado = a.DNI INNER JOIN estudiante e ON pa.idApoderado = e.idApoderado WHERE pa.state='PAGO' and pa.fechapago= (SELECT MAX(fechapago) from pagoapafa)";
			$respuestaConsulta = $this->consulta($sql);
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$pagosapafa[]=$filas;
			}
			return $pagosapafa;
		}

		
		function showUsers(){
			$sql="SELECT concat(u.firstname,' ',u.lastName)as nombre, u.email, u.rol, u.status, u.created_at as fecha FROM usuario u";
			$respuestaConsulta = $this->consulta($sql);
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$usuarios[]=$filas;
			}
			return $usuarios;
		}





	}

 ?>