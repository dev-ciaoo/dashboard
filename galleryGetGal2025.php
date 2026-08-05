<?php
header('Content-Type: application/json');
$directory = './workshop/xmas2025/';
$files = array_diff(scandir($directory), array('..', '.')); // Exclude . and ..

// Return only video files (you can customize the extensions)
$videoFiles = array_filter($files, function($file) {
    return preg_match('/\.(jpeg|jpg)$/i', $file); // Add other video formats if needed
});

echo json_encode(array_values($videoFiles)); // Return as JSON
?>
