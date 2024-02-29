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
$pdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/temp']);
$pdf->SetCompression(false);
$pdf->AddPage();
$pdf->Annotation(
	"Text annotation example\nCharacters test:\xd1\x87\xd0\xb5 \xd0\xbf\xd1\x83\xd1\x85\xd1\x8a\xd1\x82 \x29 \x5c",
	145, 24, 'Comment', "Ian Back", "My Subject",
	0.7, array(127, 127, 255)
);

$pdf->Annotation(
	"LORDOFDOGS \xE2\x9C\x94 \xF0\x9F\x8D\xA3 \xE2\x98\xBA \xE2\x9D\xA4 \xF0\x9F\x8C\xB8",
	30, 30, 'Comment', "Ian Back", "My Subject",
	0.7, array(127, 127, 255)
);

$pdf->OutputFile('/var/www/myapp/pdfs/test.pdf');
?>
<h1 style="text-align:center;">Created Example!</h1>