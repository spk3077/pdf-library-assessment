<?php

require_once __DIR__ . '/vendor/autoload.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml('Load HTML');
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

$dompdf->image("logo.png", 20, 20, 80, 80);
$dompdf->text(40, 40, "TEXT");
$dompdf->page_text(10, 10, "PAGE_TEXT");
// Output the generated PDF to Browser
$dompdf->stream();

?>