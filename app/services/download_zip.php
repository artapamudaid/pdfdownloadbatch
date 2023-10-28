<?php

$zip_name = $_GET['file'];

$zipFileName = '../../storage/ziparchives/' . $zip_name;

header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . $zip_name . '"');
header('Content-Length: ' . filesize($zipFileName));

readfile($zipFileName);

exit;
