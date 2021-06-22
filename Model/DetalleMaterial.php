<?php

/**
 *
 */
class DetalleMaterial
{
var $idDetalleMaterial;
var $material;
var $estado;
var $codigoMaterial;
//nobvo
function __construct($idDetalleMaterial,$material)
{
    $this->idDetalleMaterial=$idDetalleMaterial;
    $this->material=$material;
}

public function setEstado($estado)
{
  return $this->estado=$estado;
}

public function setCodigoMaterial($codigoMaterial)
{
  return $this->codigoMaterial=$codigoMaterial;
}

public function actualizarEstadoMaterial($estado)
{
  if ($estado==1) {
    $this->setEstado("DISPONIBLE");
  }else {
    $this->setEstado("OCUPADO");
  }
}

public function generarCodigoDetalleMaterial()
{
    $codigo = "";
    $longitud=5;
    $caracteres="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $max=strlen($caracteres)-1;
    for($i=0;$i < $longitud;$i++)
    {
        $codigo.=$caracteres[rand(0,$max)];
    }
    return strtoupper($codigo);
}

}


 ?>
