<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>IT Manual - Inventory</title>
</head>
<body>
<?php
 $file = './pdf/ITManual-Inventory.pdf';
 $filename = './pdf/ITManual-Inventory.pdf';
 header('Content-type: application/pdf');
 header('Content-Disposition: inline; filename "'. $filename . '"');
 header('Content-Transfer-Encoding: binary');
 header('Content-Length: '. filesize($file).'');
 header('Accept-Ranges: bytes');
 @readfile($file);
 ?>
</body>
</html>