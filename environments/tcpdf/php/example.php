<!-- File: example.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Create Test PDF to Later Modify -->
<?php
require_once __DIR__ . '/vendor/autoload.php';

// Wipe existing PDFs
system("rm -r /var/www/myapp/pdfs/*.pdf");

// PDF to Modify
$pdf = new TCPDF();
$pdf->setFont('times', '', 14, '', true);
$pdf->setCompression(false);
$pdf->AddPage();
$pdf->Text(20, 20, "hackerd");
$pdf->Text(40, 40, "DOGTEST");
$pdf->Output('/var/www/myapp/pdfs/backslash.pdf', 'F');

// PDF without Text
$pdf = new TCPDF();
$pdf->setFont('times', '', 14, '', true);
$pdf->setCompression(false);
$pdf->AddPage();
$pdf->Output('/var/www/myapp/pdfs/notext.pdf', 'F');

// PDF generator for pypdf
$pdf = new TCPDF();
$pdf->setFont('times', '', 14, '', true);
$pdf->setCompression(false);
$pdf->AddPage();
$pdf->Text(40, 40, "DOGTEST");
$pdf->Output('/var/www/myapp/pdfs/pypdf.pdf', 'F');
?>
<h1 style="text-align:center;">Created Example!</h1>