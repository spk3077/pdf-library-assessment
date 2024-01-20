<?php

require_once __DIR__ . '/vendor/autoload.php';

$pdf = new TCPDF();
system('touch /var/www/myapp/test');

$pdf->SetCreator('Sean Kells');
$pdf->SetAuthor('Sean Kells');
$pdf->SetTitle('Test');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set font
$pdf->SetFont('times', 'BI', 20);

// add a page
$pdf->AddPage();

// set some text to print
$txt = <<<EOD
TCPDF Generated PDF

UNREAL
EOD;

// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

?>