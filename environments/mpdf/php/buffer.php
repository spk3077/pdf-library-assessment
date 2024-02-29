<!-- File: buffer.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Exploit Script (Buffer Overflow) for mPDF -->
<?php
require_once __DIR__ . '/vendor/autoload.php';

// Wipe existing PDFs
system("rm -r /var/www/myapp/pdfs/*");

$MAX_COUNT = 10000;

function createPDF() {
    $pdf = new TCPDF();
    $pdf->setFont('times', '', 14, '', true);
    $pdf->setCompression(false);
    $pdf->AddPage();
    return $pdf;
}

// Creator
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetCreator(str_repeat("V", $i));
    $pdf->Output('/var/www/myapp/pdfs/creator.pdf', 'F');
    $i++;
}

// Author
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetAuthor(str_repeat("V", $i));
    $pdf->Output('/var/www/myapp/pdfs/author.pdf', 'F');
    $i++;
}

// Title
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetTitle(str_repeat("V", $i));
    $pdf->Output('/var/www/myapp/pdfs/title.pdf', 'F');
    $i++;
}

// Subject
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetSubject(str_repeat("V", $i));
    $pdf->Output('/var/www/myapp/pdfs/subject.pdf', 'F');
    $i++;
}

// Keywords
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetKeywords(str_repeat("V", $i));
    $pdf->Output('/var/www/myapp/pdfs/keywords.pdf', 'F');
    $i++;
}

// Direct Image Stream
$imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->Image('@'.$imgdata.str_repeat("V", $i), 15, 140, 50, 50, '', '', '', true, 150, '', false, false, 1, false, false, false);
    $pdf->Output('/var/www/myapp/pdfs/directimage.pdf', 'F');
    $i++;
}

// Image Links
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->Image("/var/www/myapp/images/xref.jpg", 15, 140, 50, 50, "JPEG", str_repeat("V", $i), '', true, 150, '', false, false, 1, false, false, false);
    $pdf->Output('/var/www/myapp/pdfs/linkimage.pdf', 'F');
    $i++;
}

// Write
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->Write(0, str_repeat("V", $i), str_repeat("V", $i), 0, 'C', true, 0, false, false, 0);
    $pdf->Output('/var/www/myapp/pdfs/write.pdf', 'F');
    $i++;
}

// WriteHTML
// Not Looping because it takes a VERY long
$pdf = createPDF();
$pdf->writeHTML(str_repeat("V", $MAX_COUNT), true, false, true, false, '');
$pdf->Output('/var/www/myapp/pdfs/writehtml.pdf', 'F');

// WriteHTMLCell
// Not Looping because it takes a VERY long
$pdf = createPDF();
$pdf->writeHTMLCell(0, 0, '', '', str_repeat("V", $MAX_COUNT), 0, 1, 0, true, '', true);
$pdf->Output('/var/www/myapp/pdfs/writehtmlcell.pdf', 'F');

// Language Array: meta_charset
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();

    $lg = Array();
    $lg['a_meta_charset'] = str_repeat("V", $i); 
    $lg['a_meta_dir'] = 'ltr';
    $lg['a_meta_language'] = 'en';
    $lg['w_page'] = 'page';
    $pdf->setLanguageArray($lg);

    $pdf->Output('/var/www/myapp/pdfs/metachar.pdf', 'F');
    $i++;
}

// Language Array: meta_dir
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();

    $lg = Array();
    $lg['a_meta_charset'] = 'ISO-8859-1'; 
    $lg['a_meta_dir'] = str_repeat("V", $i);
    $lg['a_meta_language'] = 'en';
    $lg['w_page'] = 'page';
    $pdf->setLanguageArray($lg);

    $pdf->Output('/var/www/myapp/pdfs/metadir.pdf', 'F');
    $i++;
}

// Language Array: meta_lan
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();

    $lg = Array();
    $lg['a_meta_charset'] = 'ISO-8859-1'; 
    $lg['a_meta_dir'] = 'ltr';
    $lg['a_meta_language'] = str_repeat("V", $i);
    $lg['w_page'] = 'page';
    $pdf->setLanguageArray($lg);

    $pdf->Output('/var/www/myapp/pdfs/metalan.pdf', 'F');
    $i++;
}

// Language Array: meta_page
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();

    $lg = Array();
    $lg['a_meta_charset'] = 'ISO-8859-1'; 
    $lg['a_meta_dir'] = 'ltr';
    $lg['a_meta_language'] = 'en';
    $lg['w_page'] = str_repeat("V", $i);
    $pdf->setLanguageArray($lg);

    $pdf->Output('/var/www/myapp/pdfs/metapage.pdf', 'F');
    $i++;
}

// Text
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->Text(20, 20, str_repeat("V", $i));
    $pdf->Output('/var/www/myapp/pdfs/text.pdf', 'F');
    $i++;
}

// Cell
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->Cell(0, 0, str_repeat("V", $i), 1, 1, 'C', 0, str_repeat("V", $i), 0);
    $pdf->Output('/var/www/myapp/pdfs/cell.pdf', 'F');
    $i++;
}

// MultiCell
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->MultiCell(20, 10, str_repeat("V", $i), 1, 'J', false, 1, '' ,'', true);
    $pdf->Output('/var/www/myapp/pdfs/multicell.pdf', 'F');
    $i++;
}

// Annotation
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->Annotation(40, 40, 10, 10, str_repeat("V", $i), array('Subtype'=>'Text', 'Name' => 'Comment', 'T' => str_repeat("V", $i), 'Subj' => str_repeat("V", $i), 'C' => array(255, 255, 0)));
    $pdf->Output('/var/www/myapp/pdfs/annotation.pdf', 'F');
    $i++;
}

// Link
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->Link(10, 10, 30, 30, str_repeat("V", $i));
    $pdf->Output('/var/www/myapp/pdfs/link.pdf', 'F');
    $i++;
}

// Output
// TCPDF Error at 260 Length. File length too long. Not Buffer Overflow
$i = 1;
while ($i < 150) {
    $pdf = createPDF();
    $pdf->Text(20, 20, "DOGTEST");
    $pdf->Output('/var/www/myapp/pdfs/output'.str_repeat("V", $i), 'F');
    $i++;
}

?>
<h1 style="text-align:center;">Buffer Overflow Testing Complete!</h1>
