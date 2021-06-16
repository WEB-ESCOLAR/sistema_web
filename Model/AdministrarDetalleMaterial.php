<?php
	require_once "AdministradorModelo.php";
	class AdministrarDetalleMaterial extends AdministrarModelo{

        function disponibleDetalleMaterial($estado){ 
			$sql="SELECT * from detallematerial where status=$estado";
			$respuestaConsulta = $this->consulta($sql);
			$row = $respuestaConsulta->fetch(PDO::FETCH_ASSOC);
			if(!$row){
				return 0;
			}else{
				while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
				$disponiblematerial[]=$filas;
			}
				return $disponiblematerial;
			}

	}

    function prestadoDetalleMaterial(){ 
        $sql="SELECT dt.idMaterial,p.codePecosa,dt.status,e.firstName,e.LastName FROM prestamo p 
        inner join detallematerial dt on p.idDetalleMaterial=dt.idDetalleMaterial inner join 
        estudiante e on p.idEstudiante=e.idEstudiante";
        $respuestaConsulta = $this->consulta($sql);
        $row = $respuestaConsulta->fetch(PDO::FETCH_ASSOC);
        if(!$row){
            return 0;
        }else{
            while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
            $prestamomaterial[]=$filas;
        }
            return $prestamomaterial;
        }

}

function devueltoDetalleMaterial(){ 
    $sql="SELECT dt.idDetalleMaterial,e.firstName,e.LastName,dtv.Datetime FROM  detallematerialdevuelto dtv 
    inner join detallematerial dt on dtv.idDetalle= dt.idDetalleMaterial 
    inner join prestamo p on dt.idDetalleMaterial=p.idDetalleMaterial 
    inner join estudiante e on e.idEstudiante=p.idEstudiante";
    $respuestaConsulta = $this->consulta($sql);
    $row = $respuestaConsulta->fetch(PDO::FETCH_ASSOC);
    if(!$row){
        return 0;
    }else{
        while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
        $devueltomaterial[]=$filas;
    }
        return $devueltomaterial;
    }
 }



        function showListDetalleMaterial($type){
            if($type == "DISPONIBLE"){
                $sql = "SELECT * from detallematerial where status='DISPONIBLE'";
            }else if($type == "PRESTADO"){
                $sql="SELECT dt.idMaterial,p.codePecosa,dt.status,e.firstName,e.LastName,grado,section FROM prestamo p 
                inner join detallematerial dt on p.idDetalleMaterial=dt.idDetalleMaterial inner join 
                estudiante e on p.idEstudiante=e.idEstudiante";
            }else{
                $sql="SELECT dt.idDetalleMaterial,e.firstName,e.LastName,dtv.Datetime FROM  detallematerialdevuelto dtv 
                inner join detallematerial dt on dtv.idDetalle= dt.idDetalleMaterial 
                inner join prestamo p on dt.idDetalleMaterial=p.idDetalleMaterial 
                inner join estudiante e on e.idEstudiante=p.idEstudiante";
            }
            $respuestaConsulta = $this->consulta($sql);
            $row = $respuestaConsulta->fetch(PDO::FETCH_ASSOC);
            if(!$row){
                return 0;
            }else{
                while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
                $devueltomaterial[]=$filas;
            }
                return $devueltomaterial;
            }
        }


    }
 ?>