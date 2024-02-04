<!-- File: index.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Exploit Script for TCPDF -->
<?php
require_once __DIR__ . '/vendor/autoload.php';
require './php_payloads.php';

// Wipe existing PDFs
system("rm -r /var/www/myapp/pdfs/*.pdf");

// Creator
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetCreator($seq);
    $pdf->Output('/var/www/myapp/pdfs/creator'.$i.'.pdf', 'F');
    $i++;
}

// Author
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetAuthor($seq);
    $pdf->Output('/var/www/myapp/pdfs/author'.$i.'.pdf', 'F');
    $i++;
}

// Title
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetTitle($seq);
    $pdf->Output('/var/www/myapp/pdfs/title'.$i.'.pdf', 'F');
    $i++;
}

// Title
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetSubject($seq);
    $pdf->Output('/var/www/myapp/pdfs/subject'.$i.'.pdf', 'F');
    $i++;
}

// Keywords
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetKeywords($seq);
    $pdf->Output('/var/www/myapp/pdfs/keywords'.$i.'.pdf', 'F');
    $i++;
}

// Direct Image Stream
$imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->Image('@'.$imgdata.$seq);
    $pdf->Output('/var/www/myapp/pdfs/directimage'.$i.'.pdf', 'F');
    $i++;
}

$i = 0;
$path = "/var/www/myapp/images";
if ($handle = opendir($path)) {
    while (false !== ($file = readdir($handle))) {
        if ('.' === $file) continue;
        if ('..' === $file) continue;
        $pdf = new TCPDF();
        $pdf->AddPage();

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
        $pdf->Output('/var/www/myapp/pdfs/image'.$i.'.pdf', 'F');
        $i++;
    }
    closedir($handle);
}

// Write
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->Write(0, $seq, '', 0, 'C', true, 0, false, false, 0);
    $pdf->Output('/var/www/myapp/pdfs/write'.$i.'.pdf', 'F');
    $i++;
}

// WriteHTML
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->writeHTML($seq, true, false, true, false, '');
    $pdf->Output('/var/www/myapp/pdfs/writehtml'.$i.'.pdf', 'F');
    $i++;
}

// // // output the HTML content

// // Language Array Injection?
// $lg = Array();
// $lg['a_meta_charset'] = 'ISO-8859-1';
// $lg['a_meta_dir'] = 'ltr';
// $lg['a_meta_language'] = 'en';
// $lg['w_page'] = 'page';

// $pdf->setLanguageArray($lg);

// // write label
// $pdf->Text(20, 20, 'TEXT TCPDF');

// // Print text using writeHTMLCell()
// // $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// //Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
// $pdf->Cell(0, 0, 'TCPDF Cell', 1, 1, 'C', 0, '', 0);

// // print a blox of text using multicell()
// $pdf->MultiCell(20, 10, "TCPDF MultiCell\n", 1, 'J', false, 1, '' ,'', true);
// // text annotation
// $pdf->Annotation(40, 40, 10, 10, "TCPDF Annotation", array('Subtype'=>'Text', 'Name' => 'Comment', 'T' => 'TCPDF Title', 'Subj' => 'TCPDF Example', 'C' => array(255, 255, 0)));

// $tbl = <<<EOD
// <table cellspacing="0" cellpadding="1" border="1">
//     <tr>
//         <td rowspan="3">COL 1 - ROW 1<br />COLSPAN 3</td>
//         <td>COL 2 - ROW 1</td>
//         <td>COL 3 - ROW 1</td>
//     </tr>
//     <tr>
//         <td rowspan="2">COL 2 - ROW 2 - COLSPAN 2<br />text line<br />text line<br />text line<br />text line</td>
//         <td>COL 3 - ROW 2</td>
//     </tr>
//     <tr>
//        <td>COL 3 - ROW 3</td>
//     </tr>

// </table>
// EOD;
// $pdf->writeHTML($tbl, true, false, false, false, '');

// $pdf->Output('tcpdf.pdf', 'I');
// // $pdf->Output('/tmp/tcpdf.pdf', 'F');
// ?>
<h1 style="text-align:center;"> No Comments? Your PDF was created </h1>