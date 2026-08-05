<?php
$file = __DIR__ . '/pdf/ffeDisposal.pdf';

if (!file_exists($file)) {
    http_response_code(404);
    exit('File not found.');
}

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="ffeDisposal.pdf"');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');

readfile($file);
exit;
