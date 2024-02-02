<?php

require_once __DIR__ . '/vendor/autoload.php';
require './php_payloads.php';

$pdf = new TCPDF();
// $creator = <<<EOD

// endstream
// endobj
// EOD;
// $pdf->SetCreator($creator);
// $pdf->Output('/tmp/tcpdf.pdf', 'I');


// $pdf->SetAuthor('TCPDF Sean Kells');
// $pdf->SetTitle('TCPDF Title');
// $pdf->SetSubject('TCPDF Subject');
// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->AddPage();

// // STREAMS

// //  Image Stream
// //  Data Stream Image Attempt ('@' character)
// //  $imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');
// //  $pdf->Image('@'.$imgdata);

//  Image in File Directory
 $pdf->Image('images/dog.jpg', 15, 140, 50, 50, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

// //  $pdf->ImageSVG('images/dog.jpg', 15, 140, 50, 50, 'http://localhost.com');
// //  Write TEXT 
// // Likely no Adobe Illustrator Image File ImageEps()


// $txt = <<<EOD
// TCPDF Generated PDF

// WRITE FUNC
// EOD;
// $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// // $html = <<<EOD
// // <h1>Like exploits? <a href="http://kellsrealwww.com" style="text-decoration:none;background-color:#CC0000;color:black;"></h1>
// // <i>Couldn't tell</i>
// // <p>This is writeHTMLCell() output</p>
// // <img src="images/logo_example.png" alt="test alt attribute" width="100" height="100" border="0" /><img src="images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /><img src="images/logo_example.jpg" alt="test alt attribute" width="100" height="100" border="0" />
// // EOD;

// // // output the HTML content
// // $pdf->writeHTML($html, true, false, true, false, '');

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

$pdf->Output('tcpdf.pdf', 'I');
// // $pdf->Output('/tmp/tcpdf.pdf', 'F');
// ?>
<h1 style="text-align:center;"> No Comments? Your PDF was created </h1>