<!-- File: injection.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Exploit Script (PDF injection & Image Escape) for domPDF -->
<?php
require_once __DIR__ . '/vendor/autoload.php';
require './php_payloads.php';
use Dompdf\Dompdf;

// Wipe existing PDFs
system("rm -r /var/www/myapp/pdfs/*.pdf");

// createPDF function contains the standard process for producing PDFs for all tests
function createPDF() {
    $pdf = new Dompdf();
    $pdf->setPaper('A4', 'landscape');
    $canvas = $pdf->getCanvas();
    $canvas->set_page_count(1);
    $canvas->save();

	return $pdf;
}

// loadHTML
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();

    $pdf->loadHtml($seq);
    $pdf->render();

    $canvas = $pdf->getCanvas();
    $canvas->text(80, 120, 'DOGTEST', '/var/www/myapp/vendor/dompdf/dompdf/lib/fonts/Courier/', 18);

    $canvas->save();
    $output = $pdf->output($options = [0]);
    file_put_contents('/var/www/myapp/pdfs/loadHTML'.$i.'.pdf', $output);
    $i++;
}

// page_text
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $canvas = $pdf->getCanvas();

    $canvas->page_text(20, 20, $seq, '/var/www/myapp/vendor/dompdf/dompdf/lib/fonts/Courier/', 18);
    $canvas->text(80, 120, 'DOGTEST', '/var/www/myapp/vendor/dompdf/dompdf/lib/fonts/Courier/', 18);

    $canvas->save();
    $output = $pdf->output($options = [0]);
    file_put_contents('/var/www/myapp/pdfs/page_text'.$i.'.pdf', $output);
    $i++;
}

// Text
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $canvas = $pdf->getCanvas();

    $canvas->text(120, 120, $seq, '/var/www/myapp/vendor/dompdf/dompdf/lib/fonts/Courier/', 18);
    $canvas->text(20, 20, 'DOGTEST', '/var/www/myapp/vendor/dompdf/dompdf/lib/fonts/Courier/', 18);

    $canvas->save();
    $output = $pdf->output($options = [0]);
    file_put_contents('/var/www/myapp/pdfs/text'.$i.'.pdf', $output);
    $i++;
}

// Add_Link
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $canvas = $pdf->getCanvas();

    $canvas->add_link($seq, 30, 30, 50, 50);
    $canvas->text(20, 20, 'DOGTEST', '/var/www/myapp/vendor/dompdf/dompdf/lib/fonts/Courier/', 18);

    $canvas->save();
    $output = $pdf->output($options = [0]);
    file_put_contents('/var/www/myapp/pdfs/add_link'.$i.'.pdf', $output);
    $i++;
}

// Add_Info
$i = 0;
foreach ($escape_seq as $seq) {
    $pdf = createPDF();
    $canvas = $pdf->getCanvas();

    $canvas->add_info($seq, $seq);
    $canvas->text(20, 20, 'DOGTEST', '/var/www/myapp/vendor/dompdf/dompdf/lib/fonts/Courier/', 18);

    $canvas->save();
    $output = $pdf->output();
    file_put_contents('/var/www/myapp/pdfs/add_info'.$i.'.pdf', $output);
    $i++;
}

// Image
$i = 0;
$path = "/var/www/myapp/images";
if ($handle = opendir($path)) {
    while (false !== ($file = readdir($handle))) {
        if ('.' === $file) continue;
        if ('..' === $file) continue;
        $pdf = createPDF();
        // Add the image to the PDF
        $canvas = $pdf->getCanvas();

        $canvas->image("/var/www/myapp/images/".$file, 70, 70, 50, 50, "normal");
        $canvas->text(20, 20, 'DOGTEST', '/var/www/myapp/vendor/dompdf/dompdf/lib/fonts/Courier/', 18);

        $canvas->save();
        $output = $pdf->output($options = [0]);
        file_put_contents('/var/www/myapp/pdfs/image'.$i.'.pdf', $output);
        $i++;
    }
}

?>
<h1 style="text-align:center;">PDF Injection Complete!</h1>