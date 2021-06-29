<?php

require('fpdf.php');
require_once("../Model/AdministrarEstudiante.php");

date_default_timezone_set('America/Lima');

$DNI = $_REQUEST["id"];
// $DNI = '12387213';

class PDF extends FPDF
{

function Header(){

  $this->AddFont('Quicksand','','QuicksandBold.php');
  $this->AddFont('Quicksand','','QuicksandRegular.php');
    // Arial bold 15
    $this->SetFont('Quicksand','B',17);
    // Movernos a la derecha
    $this->SetTextColor(219, 7, 7);
    $this->Cell(80);
    $this->SetXY(5, 42);
    $this->Cell(30,10,utf8_decode('Institución Educativa Miguel Grau'),0,0);
    $this->SetTextColor(0,0,0);
    $this->SetXY(130, 110);
    $this->Cell(30,10,utf8_decode('Total:'),0,0);
    $this->SetTextColor(49, 100, 158);
    $this->SetXY(155, 110);
    $this->Cell(30,10,utf8_decode('$/ 10.00'),0,0);
    // Salto de línea
    $this->Ln(20);

}

function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

function RoundedRect($x, $y, $w, $h, $r, $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }

}

$datos = new AdministrarEstudiante();
$resultado = $datos->generarBoleta($DNI);
$fecha=date('Y-m-d h:i:s', time());
$nombre = $resultado['firstName'];
$apellido = $resultado['lastName'];


$pdf = new PDF('L', 'mm', array(130,200));
$pdf->AddFont('Quicksand','B','QuicksandBold.php');
$pdf->AddFont('Quicksand','','QuicksandRegular.php');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Quicksand','B',12);


//CELDA DEL RUC
$pdf->SetFillColor(237, 161, 179);
$pdf->SetXY(117, 21);
$pdf->RoundedRect(110, 20, 80, 11, 3.5, 'DF');
$pdf->Cell(60,10,utf8_decode("N° 24015"),0,0,'C');

//CELDA PARA LOS DATOS
$pdf->SetDrawColor(247, 96, 96);
$pdf->SetFillColor(255, 255, 255);
$pdf->RoundedRect(110, 35, 80, 23, 3.5, 'DF');
$pdf->SetFont('Quicksand','B',9);
$pdf->SetXY(111, 35);
$pdf->Cell(40,10,utf8_decode("Fecha y hora de emisión: " . $fecha),0,0);
$pdf->SetXY(111, 42);
$pdf->Cell(40,10,utf8_decode("Señor(a): " . $nombre . ' ' . $apellido),0,0);
$pdf->SetXY(111, 49);
$pdf->Cell(40,10,utf8_decode("DNI: " . $DNI),0,0);

//ESCUDO DEL COLEGIO
$pdf->Image('https://res.cloudinary.com/df3uvqrte/image/upload/v1622139170/png_image_anzdgw.png',40,5,30,0,'PNG');

//CELDA DEL PAGO
$pdf->SetFillColor(255, 255, 255);
$pdf->RoundedRect(10, 65, 180, 43, 3.5, 'DF');
$pdf->SetFont('Quicksand','B',14);
$pdf->SetXY(25, 65);
$pdf->Cell(40,10,utf8_decode("Descripción"),0,0);
$pdf->SetXY(160, 65);
$pdf->Cell(40,10,utf8_decode("Total"),0,0);
$pdf->SetXY(31, 75);
$pdf->Cell(40,10,utf8_decode("APAFA"),0,0);
$pdf->SetXY(155, 75);
$pdf->Cell(40,10,utf8_decode("$/ 10.00"),0,0);
$pdf->Line(10, 75, 210-20, 75);
$pdf->Line(145, 108 , 145, 65);

$pdf->Output('D',"boleta-".$DNI.".pdf");
 ?>
