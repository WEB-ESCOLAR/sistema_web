<?php
/**
 *
 */
class Estudiante
{
  var $dni;
  var $firstName;
  var $lastName;
  var $grade;
  var $section;

  function __construct($dni,$firstName,$lastName,$grade,$section)
  {
    $this->dni=$dni;
    $this->firstName=$firstName;
    $this->lastName=$lastName;
    $this->grade=$grade;
    $this->section=$section;
  }
}

 ?>
