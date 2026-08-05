<?php
include('connection.php');

// Turn OFF display errors for AJAX
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log');

// CRITICAL: Set JSON header BEFORE any output
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Sanitize and validate input
        $id = isset($_POST['employeeId']) ? intval($_POST['employeeId']) : 0;
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $position = isset($_POST['bankPosition']) ? trim($_POST['bankPosition']) : '';
        $branch = isset($_POST['address']) ? trim($_POST['address']) : '';
        $monthlyrate = isset($_POST['monthlyrate']) ? floatval($_POST['monthlyrate']) : 0.00;
        $riceallowance = isset($_POST['riceallowance']) ? floatval($_POST['riceallowance']) : 0.00;
        $transpo = isset($_POST['transpo']) ? floatval($_POST['transpo']) : 0.00;
        $transpoSelect = isset($_POST['transpoSelect']) ? $_POST['transpoSelect'] : '';
        $pagibig = isset($_POST['pagibig']) ? floatval($_POST['pagibig']) : 0.00;
        $sss = isset($_POST['sss']) ? floatval($_POST['sss']) : 0.00;
        $sssmand = isset($_POST['sssmand']) ? floatval($_POST['sssmand']) : 0.00;
        $tax = isset($_POST['tax']) ? floatval($_POST['tax']) : 0.00;
        $philhealth = isset($_POST['philhealth']) ? floatval($_POST['philhealth']) : 0.00;
        $otherAllow = isset($_POST['otherAllow']) ? floatval($_POST['otherAllow']) : 0.00;
        $otherAllowSelect = isset($_POST['otherAllowSelect']) ? $_POST['otherAllowSelect'] : '';
        $specialAllow = isset($_POST['specialAllow']) ? floatval($_POST['specialAllow']) : 0.00;
        $sssEmployer = isset($_POST['sssEmployer']) ? floatval($_POST['sssEmployer']) : 0.00;
        $sssmandEmployer = isset($_POST['sssmandEmployer']) ? floatval($_POST['sssmandEmployer']) : 0.00;
        $pagibigEmployer = isset($_POST['pagibigEmployer']) ? floatval($_POST['pagibigEmployer']) : 0.00;
        $philhealthEmployer = isset($_POST['philhealthEmployer']) ? floatval($_POST['philhealthEmployer']) : 0.00;

        $currentDate = date("Y-m-d");

        // Validate required fields
        if ($id <= 0) {
            throw new Exception('Invalid employee ID');
        }

        // Check if the employee ID exists in the pay_earningshr table
        $check_query = "SELECT employeeId FROM pay_earningshr WHERE employeeId = ?";
        $stmt_check = mysqli_prepare($con, $check_query);
        if (!$stmt_check) {
            throw new Exception('Error preparing check statement: ' . mysqli_error($con));
        }
        
        mysqli_stmt_bind_param($stmt_check, "i", $id);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);
        $num_rows = mysqli_stmt_num_rows($stmt_check);

        if ($num_rows > 0) {
            // If the employee ID exists, mark previous record as deleted
            $update_query = "UPDATE pay_earningshr SET datedeleted = ? WHERE employeeId = ?";
            $stmt_update = mysqli_prepare($con, $update_query);
            if (!$stmt_update) {
                throw new Exception('Error preparing update statement: ' . mysqli_error($con));
            }
            
            mysqli_stmt_bind_param($stmt_update, "si", $currentDate, $id);
            mysqli_stmt_execute($stmt_update);
            mysqli_stmt_close($stmt_update);
        }
        mysqli_stmt_close($stmt_check);

        // Prepare the INSERT query
        $query = "INSERT INTO pay_earningshr 
                  (employeeId, name, MonthlySalary, branch, RiceAllowance, TranspoAllowance, 
                   datemodified, pagibig, sss, sssmandprovident, withholdingtax, philhealth, 
                   specialAllow, sssEmployer, sssmandEmployer, pagibigEmployer, philhealthEmployer, 
                   transpoSelect, otherAllow, otherAllowSelect) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($con, $query);
        if (!$stmt) {
            throw new Exception('Error preparing insert statement: ' . mysqli_error($con));
        }
        
        mysqli_stmt_bind_param(
            $stmt, 
            "isssssssssssssssssss", 
            $id, $name, $monthlyrate, $branch, $riceallowance, $transpo, $currentDate, 
            $pagibig, $sss, $sssmand, $tax, $philhealth, $specialAllow, 
            $sssEmployer, $sssmandEmployer, $pagibigEmployer, $philhealthEmployer, 
            $transpoSelect, $otherAllow, $otherAllowSelect
        );
        
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception('Execute failed: ' . mysqli_stmt_error($stmt));
        }

        // Check if the operation was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo json_encode([
                'success' => true, 
                'message' => 'HR record saved successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false, 
                'message' => 'No rows affected - data may be identical to existing record'
            ]);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($con);
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false, 
            'message' => $e->getMessage()
        ]);
    }
    
    exit;
}
?>