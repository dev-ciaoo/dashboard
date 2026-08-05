<?php
$file = './pdf/unuseLeave.pdf';

if (!file_exists($file)) {
    http_response_code(404);
    exit('File not found.');
}

$filename = basename($file);

// Clear output buffer
if (ob_get_length()) {
    ob_end_clean();
}

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');

readfile($file);
exit;
?>