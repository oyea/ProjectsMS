<?php

require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

// Load the template
$templateProcessor = new TemplateProcessor('SEC.docx');
$choice = "D";
$A = $choice == "A" ? "✔" : "A";
$B = $choice == "B" ? "✔" : "B";
$C = $choice == "C" ? "✔" : "C";
$D = $choice == "D" ? "✔" : "D";
// Replace placeholders
$templateProcessor->setValue('department', 'Protection Engineering');
$templateProcessor->setValue('division', 'PED-COA');
$templateProcessor->setValue('area', 'Central');
$templateProcessor->setValue('address','Al-Dammam 1st street');
$templateProcessor->setValue('city','Dammam');
$templateProcessor->setValue('manphone','03-85291');
$templateProcessor->setValue('orgcode', '3021251456');
$templateProcessor->setValue('toman', 'EDD-COA');
$templateProcessor->setValue('ptsno', '2351');
$templateProcessor->setValue('contno', '55874112');
$templateProcessor->setValue('subject', 'Php word suite subject');
$templateProcessor->setValue('A',$A);
$templateProcessor->setValue('B',$B);
$templateProcessor->setValue('C',$C);
$templateProcessor->setValue('D',$D);
$templateProcessor->setValue('manname', 'Hussain A. Alharthi');
$templateProcessor->setValue('dno', '11');
$templateProcessor->setValue('secno', '4474');
$templateProcessor->setValue('projectname', 'UPP Multi Tech Stacks');

$templateProcessor->setImageValue('signature', [
    'path' => 'husSign.png', // Path to the image
    'width' => 150,                    // Width in pixels
    'height' => 50,                    // Height in pixels
    'ratio' => false                    // Maintain aspect ratio
]);

// Send the file to the browser for download
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="EPDS-Letter Template.docx"');
header('Cache-Control: max-age=0');

$templateProcessor->saveAs('php://output');
exit;