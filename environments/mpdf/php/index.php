<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/temp']);

$mpdf->SetTitle('My Title');
$mpdf->SetAuthor('My Name');
$mpdf->SetCreator('My Creator');
$mpdf->SetSubject('My Subject');
$mpdf->SetKeywords('My Keywords, More Keywords');

$mpdf->Annotation(
    "Text annotation example\nCharacters test:\xd1\x87\xd0\xb5 \xd0\xbf\xd1\x83\xd1\x85\xd1\x8a\xd1\x82",
    145, 24, 'Comment', "Ian Back", "My Subject",
    0.7, array(127, 127, 255)
);

$mpdf->Image('files/images/frontcover.jpg', 0, 0, 210, 297, 'jpg', '', true, false);

$mpdf->AutosizeText('doggo', 15.0, 'times', '', 72);

$mpdf->MultiCell( 20.0, 20.0, 'gatto');

$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->WriteCell(120, 120, "The Main Doggo");



// ALL BELOW FOR OVERWRITING EXISTING PDF TEXT (searches for pattern)
$mpdf->SetImportUse(); // only with mPDF <8.0

// forces no subsetting - otherwise the inserted characters may not be contained
// in a subset font
$mpdf->percentSubset = 0;

$search = array(
	'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
	'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXZZZZZZZZ'
);

$replacement = array(
	"personalised for Jos\xc3\xa9 Bloggs",
	"COPYRIGHT: Licensed to Jos\xc3\xa9 Bloggs"
);

$mpdf->OverWrite('test.pdf', $search, $replacement, 'I', 'mpdf.pdf');





$mpdf->OutputFile(__DIR__ . '/file.pdf');
$mpdf->Output();

?>