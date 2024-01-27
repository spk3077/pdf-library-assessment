<?php

require_once __DIR__ . '/vendor/autoload.php';
use Fpdf\Fpdf;

$pdf = new FPDF();
$pdf->AddPage();

// SetCompression() - can this break things?
$pdf->SetAuthor("Sean Kells");
$pdf->SetCreator("Sean Kells");
$pdf->SetKeywords('keyword1, keyword2');

$pdf->SetFont('Arial','B',16);
$pdf->Text(100, 100, "FPDF Text");
$pdf->Write(120, "Write FPDF", "http://localhost");

$pdf->Cell(40,10,'Cell FPDF!');
$pdf->MultiCell(20, 20, "MultiCell");

$pdf->Image('logo.png', 60, 30, 90, 0, 'PNG', "http://localhost");
$pdf->Output();

?>