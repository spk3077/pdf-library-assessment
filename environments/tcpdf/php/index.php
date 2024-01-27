<?php

require_once __DIR__ . '/vendor/autoload.php';

$pdf = new TCPDF();

# Basic Stagnant Details
$pdf->SetFont('times', 'BI', 20);
$pdf->setJPEGQuality(75);

# STREAMS
$pdf->SetCreator('Sean Kells');
$pdf->SetAuthor('Sean Kells');
$pdf->SetTitle('Test');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->AddPage();


## Image Stream
// Data Stream Image Attempt ('@' character)
// $imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');
// $pdf->Image('@'.$imgdata);

// Image in File Directory
$pdf->Image('images/dog.jpg', 15, 140, 50, 50, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

$pdf->ImageSVG('images/dog.jpg', 15, 140, 50, 50, 'http://localhost.com');
// Write TEXT 
$txt = <<<EOD
TCPDF Generated PDF

UNREAL
EOD;
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

$html = <<<EOD
<h1>Like exploits? <a href="http://kellsrealwww.com" style="text-decoration:none;background-color:#CC0000;color:black;"></h1>
<i>Couldn't tell</i>
<p>This is writeHTMLCell() output</p>
<img src="images/logo_example.png" alt="test alt attribute" width="100" height="100" border="0" /><img src="images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /><img src="images/logo_example.jpg" alt="test alt attribute" width="100" height="100" border="0" />
EOD;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Language Array Injection?
$lg = Array();
$lg['a_meta_charset'] = 'ISO-8859-1';
$lg['a_meta_dir'] = 'ltr';
$lg['a_meta_language'] = 'en';
$lg['w_page'] = 'page';

$pdf->setLanguageArray($lg);

// write label
$pdf->Text(20, 130, 'LinearGradient()');

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
$pdf->Cell(0, 0, 'TEST CELL STRETCH: no stretch', 1, 1, 'C', 0, '', 0);

// set some text for example
$txt = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue. Sed vel velit erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras eget velit nulla, eu sagittis elit. Nunc ac arcu est, in lobortis tellus. Praesent condimentum rhoncus sodales. In hac habitasse platea dictumst. Proin porta eros pharetra enim tincidunt dignissim nec vel dolor. Cras sapien elit, ornare ac dignissim eu, ultricies ac eros. Maecenas augue magna, ultrices a congue in, mollis eu nulla. Nunc venenatis massa at est eleifend faucibus. Vivamus sed risus lectus, nec interdum nunc.

Fusce et felis vitae diam lobortis sollicitudin. Aenean tincidunt accumsan nisi, id vehicula quam laoreet elementum. Phasellus egestas interdum erat, et viverra ipsum ultricies ac. Praesent sagittis augue at augue volutpat eleifend. Cras nec orci neque. Mauris bibendum posuere blandit. Donec feugiat mollis dui sit amet pellentesque. Sed a enim justo. Donec tincidunt, nisl eget elementum aliquam, odio ipsum ultrices quam, eu porttitor ligula urna at lorem. Donec varius, eros et convallis laoreet, ligula tellus consequat felis, ut ornare metus tellus sodales velit. Duis sed diam ante. Ut rutrum malesuada massa, vitae consectetur ipsum rhoncus sed. Suspendisse potenti. Pellentesque a congue massa.';

// print a blox of text using multicell()
$pdf->MultiCell(80, 5, $txt."\n", 1, 'J', 1, 1, '' ,'', true);
// text annotation
$pdf->Annotation(83, 27, 10, 10, "Text annotation example\naccented letters test: àèéìòù", array('Subtype'=>'Text', 'Name' => 'Comment', 'T' => 'title example', 'Subj' => 'example', 'C' => array(255, 255, 0)));


$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td rowspan="3">COL 1 - ROW 1<br />COLSPAN 3</td>
        <td>COL 2 - ROW 1</td>
        <td>COL 3 - ROW 1</td>
    </tr>
    <tr>
        <td rowspan="2">COL 2 - ROW 2 - COLSPAN 2<br />text line<br />text line<br />text line<br />text line</td>
        <td>COL 3 - ROW 2</td>
    </tr>
    <tr>
       <td>COL 3 - ROW 3</td>
    </tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');


// Likely no Adobe Illustrator Image File ImageEps()
$pdf->Output('tcpdf.pdf', 'I');
?>