<?php
require('fpdf.php');
require_once("../core/initial.php");
require_once("../Model/AdministrarDetalleMaterial.php");

$idMaterial = $_REQUEST["idMaterial"];
$count = 1;
$materialModel = new AdministrarDetalleMaterial();
$result=$materialModel->headerPDF($idMaterial);
$curso=$result["descripcion"];
$fecha=date('Y-m-d h:i:s', time()); 
$grado=$result["grade"];
$tipo=$result["tipoMaterial"];
// $idMaterial = 436662;
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
    $this->Cell(30,10,utf8_decode('REPORTE DE MATERIALES PRESTADOS'),0,0,'C');
    $this->SetXY(5, 30);
    $this->SetFont('Quicksand','B',12);
    $this->Cell(30,10,utf8_decode("Curso: ".$GLOBALS['curso']),0,0,'L');
    $this->SetXY(80, 30);
    $this->Cell(30,10,utf8_decode("Fecha Hora de Reporte:".$GLOBALS['fecha']),0,0,'L');
    $this->SetXY(5, 40);
    $this->Cell(30,10,utf8_decode("Grado: ".$GLOBALS['grado']),0,0,'C');
    $this->SetXY(80, 40);
    $this->Cell(30,10,utf8_decode("Tipo de Material: ".$GLOBALS['tipo']),0,0,'L');
    $this->Image(URL."/Web/img/logo_login.jpeg",175,7,25,0,'JPEG');

    // Salto de línea
    $this->Ln(20);
    // Arial bold 15
    $this->SetFont('Quicksand','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
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
$pdf->SetFont('Quicksand','B',10);
$pdf->SetY(59);

$materialModel = new AdministrarDetalleMaterial();
$resultado = $materialModel->showGenerarReporte('PRESTADOS',$idMaterial);

$pdf->Cell(25,10,utf8_decode("N°"),0,0,'C');
$pdf->Cell(50,10,"NOMBRE Y APELLIDO ESTUDIANTE",0,0,'C');
$pdf->Cell(35,10,"SECCION",0,0,'C');
$pdf->Cell(30,10,"CODIGO PECOSA",0,0,'C');
$pdf->Cell(50,10,"FECHA PRESTAMO",0,1,'C');
$pdf->SetFont('Quicksand','',10);
while ($data =$resultado->fetch(PDO::FETCH_OBJ)) {
  $pdf->Cell(23,8,$count++,'T',0,'C');
  $pdf->Cell(47,8,$data->Nombre .' '.$data->Apellido,'T',0,'C');
  $pdf->Cell(45,8,$data->section,'T',0,'C');
  $pdf->Cell(20,8,$data->codePecosa,'T',0,'C');
  $pdf->Multicell(55,8,$data->fechaHora,'T','C',false);
  // $pdf->Line(20,45,210-20,45);
}

$pdf->Output('D',utf8_decode("reporteMaterialesPrestados.pdf"));
?>