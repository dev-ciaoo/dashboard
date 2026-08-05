<?php
header('Content-Type: application/json');

$month = $_GET['month'] ?? '';
$directory = './workshop/video/general-monthly/' . $month . '/';

if (!is_dir($directory)) {
    echo json_encode([]); // Invalid or missing folder
    exit;
}

$files = array_diff(scandir($directory), array('.', '..'));

$videoFiles = array_filter($files, function($file) use ($directory) {
    $allowedExtensions = ['mp4', 'avi', 'mov'];
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    return in_array(strtolower($extension), $allowedExtensions) && !is_dir($directory . $file);
});

echo json_encode(array_values($videoFiles));