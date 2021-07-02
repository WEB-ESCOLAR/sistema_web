<?php
require('fpdf.php');
require_once("../Model/AdministrarDetalleMaterial.php");

$idMaterial = $_REQUEST["idMaterial"];
// $idMaterial = 731965;
$count = 1;
$materialModel = new AdministrarDetalleMaterial();
$result=$materialModel->headerPDF($idMaterial);
// echo var_dump($result);
$curso=$result["descripcion"];
$fecha=date('Y-m-d h:i:s', time()); 
$grado=$result["grade"];
$tipo=$result["tipoMaterial"];
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
    $this->SetXY(5, 30);
    $this->SetFont('Quicksand','B',12);
    $this->Cell(30,10,utf8_decode("Curso: ".$GLOBALS['curso']),0,0,'L');
    $this->SetXY(78, 30);
    $this->Cell(30,10,utf8_decode("Fecha Hora de Reporte:".$GLOBALS['fecha']),0,0,'L');
    $this->SetXY(5, 40);
    $this->Cell(30,10,utf8_decode("Grado: ".$GLOBALS['grado']),0,0,'C');
    $this->SetXY(78, 40);
    $this->Cell(30,10,utf8_decode("Tipo de Material: ".$GLOBALS['tipo']),0,0,'L');
    $this->Image('https://res.cloudinary.com/df3uvqrte/image/upload/v1622139170/png_image_anzdgw.png',175,7,25,0,'PNG');

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


$resultado = $materialModel->showGenerarReporte('DANADO',$idMaterial);

$pdf->Cell(60,10,utf8_decode("N°"),0,0,'C');
$pdf->Cell(60,10,"CODIGO DE LIBRO",0,0,'C');
$pdf->Cell(60,10,"MOTIVO",0,1,'C');
$pdf->SetFont('Quicksand','',10);
$fecha=date('Y-m-d h:i:s', time());
while ($data =$resultado->fetch(PDO::FETCH_OBJ)) {
  $pdf->cell(60,8,$count++,'T',0,'C');
  $pdf->cell(60,8,$data->codigo,'T',0,'C');
  $pdf->Multicell(60,8,$data->motivo,'T','C',false);
}


$pdf->Output('D',utf8_decode("reporteMaterialesDañados.pdf"));
?>
