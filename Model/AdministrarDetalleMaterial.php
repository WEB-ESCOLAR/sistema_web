<?php
	require_once "AdministradorModelo.php";
	class AdministrarDetalleMaterial extends AdministrarModelo{




        function showListDetalleMaterial($type,$idDeMaterial){
            if($type == "DISPONIBLE"){
                $sql = "SELECT * from detallematerial where status='DISPONIBLE'and idMaterial=$idDeMaterial";
            }else if($type == "PRESTADO"){
                $sql="SELECT pv.idPrestamoDevolucion, pv.idEstudiante,dt.idMaterial,dt.idDetalleMaterial,pv.codePecosa,dt.status,
        e.firstName,e.LastName,e.grado,e.section FROM prestamodevolucion pv 
                inner join detallematerial dt on pv.idDetalleMaterial=dt.idDetalleMaterial inner join 
                estudiante e on pv.idEstudiante=e.idEstudiante WHERE pv.fechaHoraDevolucion is null and idMaterial=$idDeMaterial";
            }else{
                $sql="SELECT pv.idPrestamoDevolucion,e.firstName,e.LastName,e.grado,e.section,pv.fechaHoraDevolucion FROM  prestamodevolucion pv 
                inner join detallematerial dt on pv.idDetalleMaterial= dt.idDetalleMaterial 
                inner join estudiante e on e.idEstudiante=pv.idEstudiante where pv.fechaHoraDevolucion is not null and dt.idMaterial=$idDeMaterial";    
        }
            $respuestaConsulta = $this->consulta($sql);
                while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
                $devueltomaterial[]=$filas;
            }
            if(empty($devueltomaterial)){
                $devueltomaterial=[];
            }
            return $devueltomaterial;
        }

        function showGenerarReporte($type,$idMaterial){
            if($type == "PRESTADOS"){
                //sentencia 
            }else if($type == "DEVUELTOS"){
                // sentencia aca 
            }else{
                //sentencia aca 
            }
            //utilizar variable de sql
            $respuestaConsulta = $this->consulta($sql);
            while($filas = $respuestaConsulta->fetch(PDO::FETCH_ASSOC)) {
            $dataBody[]=$filas;
        }
            return $dataBody;
        }


    }
 ?>