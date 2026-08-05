<!-- <?php
include('connection.php');
include('fileupload.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payroll System</title>
</head>
<body>
    <h1>Upload Payroll CSV</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="csvFile" accept=".csv" required>
        <button type="submit" class="btn btn-secondary upload-btn">Upload</button>
    </form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "payroll/"; // Directory to store uploaded files
    $targetFile = $targetDir . basename($_FILES["csvFile"]["name"]);
    
    
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Check if file is a CSV
    if ($fileType != "csv") {
        echo "Only CSV files are allowed.";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
        echo "File upload failed.";
    } else {
        if (move_uploaded_file($_FILES["csvFile"]["tmp_name"], $targetFile)) {
            // Process the CSV file, e.g., read data, calculate payroll, etc.
            // You can use libraries like fgetcsv to parse the CSV data.
            
            // Example: Reading CSV data
            $csvData = array_map('str_getcsv', file($targetFile));
            // Process $csvData and perform calculations
            $csvFile = './payroll/testcsv.csv';
            $file = fopen($csvFile, 'r');

            // Skip the header row
            fgetcsv($file);

            while (($data = fgetcsv($file)) !== false) {
                $employeeName = $data[0];
                $hoursWorked = (float) $data[1];
                $hourlyRate = (float) $data[2];
                
                // Calculate earnings
                $earnings = $hoursWorked * $hourlyRate;
                
                // Display or store results
                echo "Employee: $employeeName, Earnings: $earnings\n";
            }

            fclose($file);

            echo "File uploaded and processed successfully.";
        } else {
            echo "File upload failed.";
        }
    }
}
?>
</body>
</html> -->