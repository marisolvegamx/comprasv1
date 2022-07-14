<?php
require ('../fpdf/fpdf.php');


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
	$this->Image('../Views/dist/img/muesmerc_logo.png' , 20 ,6, 40 , 20,'PNG');
    $this->SetFont('Arial','B',18);
    // Movernos a la posicion
    $this->SetY(18);
    $this->SetX(80);    // Título
	$this->Cell( 80 , 6 , "LISTA DE COMPRA", 0,  0, 'C',false);
    $this->SetLineWidth(0.4);   // ancho de linea
    $this->SetFillColor(0,0,0);
    $this->Rect(10,30,200,1);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-22);
    // Arial italic 8
    $this->SetFont('Arial','',8);
    // Número de página
	$this->Rect(10,256,200,1);
    $this->Cell( 0 , 8 , "Republicas 241-C * Col. Santa Cruz Atoyac * Delegacion Benito Juarez * Mexico D.F. * C.P. 03310", 0,  0, 'C');
	$this->SetY(-18);
	$this->Cell( 0 , 8 , "Tel (55) 5688-0408  5601-8688  01-800-830-5195  * muesmerc@muesmerc.com.mx", 0,  0, 'C',false);
}
}
$pdf=new PDF('p','mm','letter');
$pdf->AddPage();

//**** ETIQUETAS
$pdf->SetFont('Arial','',12);
//$pdf->SetFillColor(184,211,235);
//$pdf->Rect(15,46,35,4,F);
$pdf->SetY(36);
$pdf->SetX(23);

$pdf->Cell(25,4,'CLIENTE :', 0, 'R' , TRUE);
$pdf->SetY(41);
$pdf->SetX(23);

$pdf->Cell(25,4,'PLANTA :', 0, 'R' , TRUE);
$pdf->SetY(46);
$pdf->SetX(23);
$pdf->Cell(25,4,'INDICE :', 0, 'R' , TRUE);
$pdf->SetY(52);
$pdf->SetX(23);
$pdf->Cell(25,4,'RECOLECTOR :', 0, 'R' , TRUE);

$pdf->SetFont('Arial','',8);

$pdf->SetY(65);
$pdf->SetX(5);

$pdf->Cell(25,4,'PRODUCTO', 0, 'R' , TRUE);
//$pdf->Rect(15,52,35,4,F);
$pdf->SetY(65);
$pdf->SetX(20);

$pdf->Cell(25,4,'TAMAÑO', 0, 'R' , TRUE);
$pdf->SetY(65);
$pdf->SetX(35);

$pdf->Cell(25,4,'EMPAQUE', 0, 'R' , TRUE);
$pdf->SetY(65);
$pdf->SetX(50);

$pdf->Cell(25,4,'ANALISIS', 0, 'R' , TRUE);
$pdf->SetY(65);
$pdf->SetX(70);

$pdf->Cell(25,4,'CANTIDAD', 0, 'R' , TRUE);

$pdf->SetY(65);
$pdf->SetX(80);

$pdf->Cell(25,4,'TIPO ', 0, 'R' , TRUE);
$pdf->SetY(65);
$pdf->SetX(120);

$pdf->Cell(25,4,'C NO PERMITIDOS', 0, 'R' , TRUE);
$pdf->SetY(65);
$pdf->SetX(150);

$pdf->Cell(25,4,'RESTRINGUIR C', 0, 'R' , TRUE);
$pdf->SetY(65);
$pdf->SetX(165);

$pdf->Cell(25,4,'PERMITIR C', 0, 'R' , TRUE);

$pdf->SetY(65);
$pdf->SetX(180);

$pdf->Cell(25,4,'BACKUP', 0, 'R' , TRUE);

$pdf->Output();
?>