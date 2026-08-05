<?php
include('connection.php');

// ✅ FIX: Validate and sanitize inputs with proper type checking
$newlatehrs = isset($_GET['newlatehrs']) ? $_GET['newlatehrs'] : '0';
$newremarks = isset($_GET['newremarks']) ? $_GET['newremarks'] : '';
$exempt = isset($_GET['exempt']) ? $_GET['exempt'] : '0';
$id = isset($_GET['id']) ? $_GET['id'] : '';

// ✅ FIX: Validate that ID exists and is numeric
if(empty($id) || !is_numeric($id)){
    echo "Error: Invalid ID";
    exit;
}

// ✅ FIX: Validate newlatehrs is numeric
if(!is_numeric($newlatehrs) || $newlatehrs < 0){
    echo "Error: Invalid late hours value";
    exit;
}

// ✅ FIX: Validate exempt is either 0 or 1
if($exempt !== '0' && $exempt !== '1'){
    echo "Error: Invalid exempt value";
    exit;
}

// ✅ FIX: Escape values after validation
$newlatehrs = mysqli_real_escape_string($con, $newlatehrs);
$newremarks = mysqli_real_escape_string($con, $newremarks);
$exempt = mysqli_real_escape_string($con, $exempt);
$id = mysqli_real_escape_string($con, $id);

// ✅ FIX: Use prepared statement for better security
$sql = "UPDATE payroll_time SET `latehours` = ?, `remarks` = ?, `exempt` = ? WHERE `time_id` = ?";
$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "dssi", $newlatehrs, $newremarks, $exempt, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        // ✅ FIX: Check if any row was actually updated
        if(mysqli_stmt_affected_rows($stmt) > 0){
            echo "Data updated in payroll_time table successfully.<br>";
        } else {
            echo "No record found with the specified ID or no changes made.<br>";
        }
    } else {
        echo "Error executing query: " . mysqli_stmt_error($stmt);
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($con);
}

// Close connection
mysqli_close($con);
?>