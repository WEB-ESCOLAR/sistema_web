<?php
	require_once "AdministradorModelo.php";
	class AdministrarDetalleMaterial extends AdministrarModelo{




        function showListDetalleMaterial($type,$idDeMaterial){
            if($type == "DEFAULT"){
                $sql="SELECT * from detallematerial where idMaterial=$idDeMaterial";
            }
            else if($type == "DISPONIBLE"){
                $sql = "SELECT * from detallematerial where status='DISPONIBLE'and idMaterial=$idDeMaterial";
            }else if($type == "PRESTADO"){
                $sql="SELECT pv.idPrestamoDevolucion, pv.idEstudiante,dt.idMaterial,dt.idDetalleMaterial,pv.codePecosa,dt.status,
        e.firstName,e.LastName,e.grado,e.section FROM prestamodevolucion pv
                inner join detallematerial dt on pv.idDetalleMaterial=dt.idDetalleMaterial inner join
                estudiante e on pv.idEstudiante=e.idEstudiante WHERE pv.fechaHoraDevolucion is null and idMaterial=$idDeMaterial";
            }else  if($type == "DEVUELTO"){
                $sql="SELECT pv.idPrestamoDevolucion,e.firstName,e.LastName,e.grado,e.section,
        pv.fechaHoraDevolucion FROM  prestamodevolucion pv
                inner join detallematerial dt on pv.idDetalleMaterial= dt.idDetalleMaterial
                inner join estudiante e on e.idEstudiante=pv.idEstudiante where pv.fechaHoraDevolucion is not null and dt.status!=3 and dt.idMaterial=$idDeMaterial";
            }else{
                $sql="SELECT dt.codigo,motivo,pv.fechaHoraDevolucion FROM  prestamodevolucion pv 
                inner join detallematerial dt on pv.idDetalleMaterial= dt.idDetalleMaterial 
                where pv.fechaHoraDevolucion is not null 
                and dt.idMaterial=$idDeMaterial and dt.status=3";    
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
                $sql="SELECT dv.idDetalleMaterial, e.firstName as Nombre ,e.LastName as Apellido,dt.idMaterial,pv.codePecosa,dv.fechaHora,e.section
                FROM prestamodevolucion pv inner join detallematerial dt on pv.idDetalleMaterial=dt.idDetalleMaterial inner join
                    estudiante e on pv.idEstudiante=e.idEstudiante inner join prestamodevolucion dv on pv.idDetalleMaterial=dv.idDetalleMaterial
                    WHERE dt.status = 2 and dt.idMaterial = $idMaterial";
            }else if($type == "DEVUELTO"){
                // sentencia aca
                $sql="SELECT CONCAT(e.firstName,' ',e.LastName) AS 'nombre',e.section AS 'seccion', pd.fechaHoraDevolucion AS 'fechaDevolucion', pd.motivo AS 'motivo' 
                FROM prestamodevolucion pd INNER JOIN estudiante e ON pd.idEstudiante = e.idEstudiante INNER JOIN detallematerial dm ON dm.idDetalleMaterial = pd.idDetalleMaterial 
                WHERE dm.idMaterial=$idMaterial and pd.fechaHoraDevolucion is not null and dm.status!=3";

            }else{    
							$sql="SELECT pd.idDetalleMaterial, dm.codigo, pd.motivo from detallematerial dm inner join prestamodevolucion pd
							on dm.idDetalleMaterial = pd.idDetalleMaterial
							where dm.status = 3 and dm.idMaterial = $idMaterial";
            }
            $respuestaConsulta = $this->consulta($sql);
            return $respuestaConsulta;
        }
        function headerPDF($idMaterial){
                $sql="SELECT c.descripcion, m.grade, m.tipoMaterial FROM curso c INNER JOIN material m 
                ON m.idCurso=c.idCurso WHERE m.idMaterial= ?";
                $respuestaConsulta = $this->getConexion()->prepare($sql);
                $respuestaConsulta->bindParam(1,$idMaterial);
                $result= $respuestaConsulta->execute();
                $result = $respuestaConsulta->fetch(PDO::FETCH_ASSOC);
                return $result;
    
    }


    }
 ?>
