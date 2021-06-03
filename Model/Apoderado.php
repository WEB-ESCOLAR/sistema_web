<?php
/**
 *
 */
class Apoderado
{
  var $dni;
  var $firstName;
  var $lastName;
  var $telefono;

  function __construct($dni,$firstName,$lastName,$telefono)
  {
    $this->dni=$dni;
    $this->firstName=$firstName;
    $this->lastName=$lastName;
    $this->telefono=$telefono;
  }
}

 ?>
