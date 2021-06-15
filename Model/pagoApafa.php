<?php
/**
 *
 */
class PagoApafa
{
  var $idPagoApafa;
  var $estadoPagoApafa;
  var $fechaPagoApafa;
  var $DniApoderado;


  function __construct($idPagoApafa,$estadoPagoApafa,$fechaPagoApafa,$DniApoderado)
  {
    $this->idPagoApafa=$idPagoApafa;
    $this->estadoPagoApafa=$estadoPagoApafa;
    $this->fechaPagoApafa=$fechaPagoApafa;
    $this->DniApoderado=$DniApoderado;
  }
}
 ?>