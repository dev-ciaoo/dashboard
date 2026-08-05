<?php
header('Content-Type: application/json');

$baseDir = './workshop/video/general-monthly/';
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/dashboard/workshop/video/general-monthly/';

$monthlyFolders = array_filter(scandir($baseDir), function ($folder) use ($baseDir) {
    return is_dir($baseDir . $folder) && !in_array($folder, ['.', '..']);
});

$result = [];

foreach ($monthlyFolders as $folder) {
    $folderPath = $baseDir . $folder . '/';
    $files = array_diff(scandir($folderPath), ['.', '..']);
    $videoList = [];

    foreach ($files as $file) {
        if (preg_match('/\.(mp4|avi|mov|MP4|MOV|AVI)$/i', $file)) {
            $videoList[] = $baseUrl . $folder . '/' . $file;
        }
    }

    // Add folder if it has videos or always if you want folders displayed even if empty
    $result[$folder] = $videoList;
}

echo json_encode($result);
