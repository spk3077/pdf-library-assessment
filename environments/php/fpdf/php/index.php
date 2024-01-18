<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/temp']);
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();

?>