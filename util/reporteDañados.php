<?php
require('fpdf.php');
require_once("../Model/AdministrarDetalleMaterial.php");

// $idMaterial = $_REQUEST["idMaterial"];
$idMaterial = 436662;
$count = 1;
class PDF extends FPDF
{

function Header()
{
  $this->AddFont('Quicksand','','QuicksandBold.php');
  $this->AddFont('Quicksand','','QuicksandRegular.php');
    // Arial bold 15
    $this->SetFont('Quicksand','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,utf8_decode('REPORTE DE MATERIALES DAÑADOS'),0,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AddFont('Quicksand','B','QuicksandBold.php');
$pdf->AddFont('Quicksand','','QuicksandRegular.php');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Quicksand','B',12);

$materialModel = new AdministrarDetalleMaterial();
$resultado = $materialModel->showGenerarReporte('DANADO',$idMaterial);

$pdf->Cell(60,10,utf8_decode("N°"),0,0,'C');
$pdf->Cell(60,10,"CODIGO DE LIBRO",0,0,'C');
$pdf->Cell(60,10,"MOTIVO",0,1,'C');
$pdf->SetFont('Quicksand','',10);
while ($data =$resultado->fetch(PDO::FETCH_OBJ)) {
  $pdf->cell(60,8,$count++,0,0,'C');
  $pdf->cell(60,8,$data->codigo,0,0,'C');
  $pdf->Multicell(60,8,$data->motivo,'B','C',false);
  // $pdf->Line(20,45,210-20,45);
}

$pdf->Output('I','reporteDa.pdf');
?>
