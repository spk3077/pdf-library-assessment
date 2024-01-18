<?php

require_once __DIR__ . '/vendor/autoload.php';
use Fpdf\Fpdf;

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'FPDF!');
$pdf->Output();

?>