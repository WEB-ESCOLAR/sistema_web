<?php

class Apoderado
{
  var $DniApoderado;
  var $nombreApoderado;
  var $apellidoApoderado;
  var $telefonoApoderado;

  function __construct($DniApoderado,$nombreApoderado,$apellidoApoderado,$telefonoApoderado)
  {
    $this->DniApoderado=$DniApoderado;
    $this->nombreApoderado=$nombreApoderado;
    $this->apellidoApoderado=$apellidoApoderado;
    $this->telefonoApoderado=$telefonoApoderado;
  }
}

 ?>
