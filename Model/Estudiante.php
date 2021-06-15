<?php
/**
 *
 */
namespace Model;

class Estudiante
{
  var $idEstudiante;
  var $DniEstudiante;
  var $nombreEstudiante;
  var $apellidoEstudiante;
  var $gradoEstudiante;
  var $seccionEstudiante;
  var $idUsuario;
  $apodero = new Apoderado;

  function __construct($idEstudiante,$DniEstudiante,$nombreEstudiante,$apellidoEstudiante,$gradoEstudiante,$seccionEstudiante,$idUsuario,Apoderado $apoderado)
  {
    $this->idEstudiante=$idEstudiante;
    $this->DniEstudiante=$DniEstudiante;
    $this->nombreEstudiante=$nombreEstudiante;
    $this->apellidoEstudiante=$apellidoEstudiante;
    $this->gradoEstudiante=$gradoEstudiante;
    $this->seccionEstudiante=$seccionEstudiante;
    $this->idUsuario=$idUsuario;
    $this->apoderado=$apoderado;
  }
}
 ?>
