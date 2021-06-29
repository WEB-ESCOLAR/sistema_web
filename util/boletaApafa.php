<?php

require('fpdf.php');
require_once("../Model/AdministrarEstudiante.php");

$DNI = '12387213';

/**
 *
 */
class PDF extends FPDF
{

function Header(){

  $this->AddFont('Quicksand','','QuicksandBold.php');
  $this->AddFont('Quicksand','','QuicksandRegular.php');
    // Arial bold 15
    $this->SetFont('Quicksand','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,utf8_decode('Institución Educativa Miguel Grau'),0,0);
    // Salto de línea
    $this->Ln(20);

}

}

$pdf = new FPDF('P', 'mm', array(100,150));

 ?>
