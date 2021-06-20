<?php
/**
 *
 */
class Estudiante
{
  var $idEstudiante;
  var $DNI;
  var $Nombre;
  var $Apellido;
  var $Grado;
  var $Seccion;
  var $Usuario;
  var $apoderado;

  function __construct($idEstudiante,$DNI,$Nombre,$Apellido,$Grado,$Seccion,$Usuario,$apoderado)
  {
    $this->idEstudiante=$idEstudiante;
    $this->DNI=$DNI;
    $this->Nombre=$Nombre;
    $this->Apellido=$Apellido;
    $this->Grado=$Grado;
    $this->Seccion=$Seccion;
    $this->Usuario=$Usuario;
    $this->apoderado=$apoderado;
  }
}
 ?>
