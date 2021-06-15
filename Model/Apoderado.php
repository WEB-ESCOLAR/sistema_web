<?php
/**
 *
 */
class Apoderado
{
  var $dni;
  var $nombre;
  var $apellido;
  var $celular;


  function __construct($dni,$nombre,$apellido,$celular)
  {
    $this->dni=$dni;
    $this->nombre=$nombre;
    $this->apellido=$apellido;
    $this->celular=$celular;
  }
}

 ?>
