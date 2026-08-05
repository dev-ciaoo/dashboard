<?php
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
        if ($_FILES["csv_file"]["error"] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["csv_file"]["tmp_name"];
            $file_name = basename($_FILES["csv_file"]["name"]);
            $target_path = "payroll/" . $file_name; // Create 'uploads' directory
            
            if (move_uploaded_file($tmp_name, $target_path)) {
                $csv_data = array_map('str_getcsv', file($target_path));
                
                // Assuming CSV format: Name, Position, Salary
                $payroll_data = array();
                foreach ($csv_data as $row) {
                    $name = $row[0];
                    $position = $row[1];
                    $salary = $row[2];
                    
                    // Here you can insert this data into a database or process it as needed
                    // Example: Insert into a MySQL database
                    // $conn = new mysqli("localhost", "username", "password", "database");
                    $sql = "INSERT INTO payroll (name, position, salary) VALUES ('$name', '$position', '$salary')";
                    $query = mysqli_query($sql, $con);
                    
                    $payroll_data[] = array("name" => $name, "position" => $position, "salary" => $salary);
                }
                
                // Output imported data (for demonstration purposes)
                echo "<h2>Imported Payroll Data:</h2>";
                echo "<table>";
                echo "<tr><th>Name</th><th>Position</th><th>Salary</th></tr>";
                foreach ($payroll_data as $row) {
                    echo "<tr><td>{$row['name']}</td><td>{$row['position']}</td><td>{$row['salary']}</td></tr>";
                }
                echo "</table>";
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "Error: " . $_FILES["csv_file"]["error"];
        }
    }
    ?>
</body>
</html>