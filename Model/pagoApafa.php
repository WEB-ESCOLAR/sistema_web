<?php
/**
 *
 */
class PagoApafa
{
  var $codigoApafa;
  var $apoderado;
  var $estado;
  var $fechaPago;

  function __construct($codigoApafa,$apoderado)
  {
    $this->codigoApafa=$codigoApafa;
    $this->apoderado=$apoderado;
  }
  
  public function setEstado($estado){
    return $this->estado = $estado;
    }
  public function setFechaPago($fechaPago){
    return $this->fechaPago = $fechaPago;
     }

  public function actualizarEstadoPagoApafa($estado){
    if($estado==1){
      $this->setEstado("PAGO");
    }else{
      $this->setEstado("NO PAGO");
      $this->setFechaPago(date("Y-m-d"),time());
    }
  }
}
 ?>