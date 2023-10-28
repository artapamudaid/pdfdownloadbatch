<?php
require '../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Inisialisasi DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$pdf = new Dompdf($options);

// Direktori untuk menyimpan file PDF
$outputDir = '../../storage/pdf-export/';

// HTML yang akan diubah menjadi PDF
$html = '<html><body><p>Contoh isi PDF</p></body></html>';

// Generate banyak file PDF
for ($i = 1; $i <= 10; $i++) {
    $pdf->loadHtml($html);
    $pdf->render();
    $pdfContent = $pdf->output();
    $pdfFileName = $outputDir . "file$i.pdf";
    file_put_contents($pdfFileName, $pdfContent);
}

$zip_name = "hasil-generate-pdf-" . date('d-m-Y') . ".zip";
// Kompresi file PDF menjadi ZIP
$zip = new ZipArchive();
$zipFileName = '../../storage/ziparchives/' . $zip_name;

if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
    for ($i = 1; $i <= 10; $i++) {
        $pdfFileName = $outputDir . "file$i.pdf";
        $zip->addFile($pdfFileName, "file$i.pdf");
    }

    $zip->close();

    $folderPath = '../../storage/pdf-export/';

    $files = scandir($folderPath);
    if ($files !== false) {
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $filePath = $folderPath . $file;
                is_file($filePath);
                unlink($filePath);
            }
        }
    }

    echo '<a href="../services/download_zip.php/?file=' . $zip_name . '" target="_blank">Download file</a>';
    exit;
}
