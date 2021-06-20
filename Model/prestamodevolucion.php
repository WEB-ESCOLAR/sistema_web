<?php

/**
 *
 */
class prestamodevolucion
{

  var $idPrestamo;
  var $Estudiante;
  var $DetalleMaterial;
  var $codigoPecosa;
  var $fechaHora;
  var $fechaHoraDevolucion;
  var $motivo;

  public function __construct($idPrestamo,$Estudiante,$DetalleMaterial,$codigoPecosa,$fechaHora,$fechaHoraDevolucion,$motivo)
  {
    $this->idPrestamo=$idPrestamo;
    $this->Estudiante=$Estudiante;
    $this->DetalleMaterial=$DetalleMaterial;
    $this->codigoPecosa=$codigoPecosa;
    $this->fechaHora=$fechaHora;
    $this->fechaHoraDevolucion=$fechaHoraDevolucion;
    $this->motivo=$motivo;
  }

}

 ?>
