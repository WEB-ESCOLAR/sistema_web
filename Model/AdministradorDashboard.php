<?php

	require_once "AdministradorModelo.php";
	class AdministrarDashboard extends AdministrarModelo{


   		function showLastpay(){
			$sql="SELECT concat(a.firstName,' ',a.lastName) as apoderado, concat(e.firstName,' ',e.LastName) as estudiante, e.grado, e.section, pa.fechaPago from pagoapafa pa INNER JOIN apoderado a on pa.idApoderado = a.DNI INNER JOIN estudiante e ON pa.idApoderado = e.idApoderado WHERE pa.state='PAGO' and pa.fechapago= (SELECT MAX(fechapago) from pagoapafa)";
			$respuestaConsulta = $this->consulta($sql);
			$respuestaConsulta->execute();
			$result = $respuestaConsulta->fetch(PDO::FETCH_ASSOC);
			return $result;
		}


		function showUsers(){
			$sql="SELECT concat(u.firstname,' ',u.lastName)as nombre, u.email, u.rol, u.status, u.created_at as fecha FROM usuario u";
			$respuestaConsulta = $this->consulta($sql);
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$usuarios[]=$filas;
			}
			return $usuarios;
		}


		function totalMaterialRegisterforNameAndType(){
			$sql="SELECT * from materialespornombretipocantidad";
			$respuestaConsulta = $this->consulta($sql);
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$materiales[]=$filas;
			}
			return $materiales;

		}

		function payApafaformonth(){
			$sql="SELECT MONTH(fechaPago) AS 'MES', (COUNT(state)) AS 'TOTAL'  FROM pagoapafa WHERE fechaPago IS NOT NULL";
			$respuestaConsulta = $this->consulta($sql);
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$payapafa[]=$filas;
			}
			return $payapafa;

		}

		function totalNumberStudentsParents(){
			$sql="SELECT COUNT(e.idEstudiante) as 'estudiantes', COUNT(a.DNI) as 'apoderados' FROM estudiante e INNER join apoderado a on e.idApoderado = a.DNI";
			$respuestaConsulta = $this->consulta($sql);
			$totalnumberSandP=[];
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$totalnumberSandP=$filas;
			}
			return $totalnumberSandP;
		}

		function totalNumberRegisterMaterial(){
			$sql="SELECT COUNT(dt.idMaterial) as 'totalDeMateriales' from material dt";
			$respuestaConsulta = $this->consulta($sql);
			$totalnumberRMaterial=[];
			while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$totalnumberRMaterial=$filas;
			}
			return $totalnumberRMaterial;
		}

		function cantidadPrestadosDevueltos(){
			$sql="select MONTH(pd.fechaHora) as 'mes', COUNT(pd.codePecosa) as 'PRESTADOS', d.devueltos
			from prestamodevolucion pd left join devoluciones d
			on d.meses = MONTH(pd.fechaHora)
			GROUP BY MONTH(fechaHora)";
			$respuestaPrestadosDevueltos = $this->consulta($sql);
			while ($filas = $respuestaPrestadosDevueltos->fetch(PDO::FETCH_ASSOC)) {
				$prestadosDevueltos[]=$filas;
			}
			return $prestadosDevueltos;
		}


	}

 ?>
