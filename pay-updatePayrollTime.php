<!-- pay-updatePayrolltime.php (DUPLICATE)--> 
<?php
// include('connection.php');

// $sql = "SELECT employeeId, MAX(id) as max_id, date, MAX(time) as max_time, MIN(time) as min_time 
//         FROM payroll 
//         GROUP BY employeeId, date, datesubmitted";
// $result = mysqli_query($con, $sql);

// if ($result) {
//     // Check if any result is found
//     if (mysqli_num_rows($result) > 0) {
//         // Output the maximum and minimum times for each employee on a specific date
//         while ($row = mysqli_fetch_assoc($result)) {
//             $emp_id = $row['employeeId'];
//             $date = $row['date'];
//             $max_time = $row['max_time'];
//             $min_time = $row['min_time'];

//             // Check if the record with the same employee ID and date already exists in payroll_time table
//             $check_sql = "SELECT * FROM payroll_time WHERE employeeId = '$emp_id' AND date = '$date'";
//             $check_result = mysqli_query($con, $check_sql);
            
//             if(mysqli_num_rows($check_result) == 0) {
//                 // Insert data into payroll_time table if no record exists with the same employee ID and date
//                 $insert_sql = "INSERT INTO payroll_time (`employeeId`, `time_in`, `time_out`, `date`)
//                                VALUES ('$emp_id', '$min_time', '$max_time', '$date')";
//                 if (mysqli_query($con, $insert_sql)) {
//                     //echo "Data inserted into payroll_time table successfully.<br>";
//                 } else {
//                     echo "Error: " . $insert_sql . "<br>" . mysqli_error($con);
//                 }
//             } else {
//                 $update_sql = "UPDATE payroll_time 
//                                SET `time_in` = '$min_time', `time_out` = '$max_time'
//                                WHERE `employeeId` = '$emp_id' AND `date` = '$date'";
//                 if (mysqli_query($con, $update_sql)) {
//                     //echo "Data updated in payroll_time table successfully.<br>";
//                 } else {
//                     echo "Error: " . $update_sql . "<br>" . mysqli_error($con);
//                 }
//             }
//         }
//     } else {
//         echo "No records found for the specified date.";
//     }
// } else {
//     echo "Error: " . $sql . "<br>" . mysqli_error($con);
// }

// $sql = "SELECT * FROM accounts 
// INNER JOIN payroll_time ON accounts.employeeId = payroll_time.employeeId";

// $result = mysqli_query($con, $sql);

// if ($result) {
//     if (mysqli_num_rows($result) > 0) {
//         while ($row = mysqli_fetch_assoc($result)) {
//             $employee_id = $row['employeeId'];
//             $account_name = $row['fullName'];
//             $time_in = $row['time_in']; // Keep as string first for NULL check
//             $time_out = $row['time_out']; // Keep as string first for NULL check
//             $monthlysalary = $row['MonthlySalary'];
//             $timeid = $row['time_id'];
//             $status = $row['status'];

//             // Check if employee is absent (no time_in or time_out)
//             if (empty($time_in) || empty($time_out) || $time_in == NULL || $time_out == NULL) {
//                 // Mark as absent
//                 if($status != '1'){
//                     $sql = "UPDATE payroll_time 
//                     SET `status` = '1', `totalhours` = '0', `name` = '$account_name', `latehours` = '8'
//                     WHERE `time_id` = '$timeid'";
//                     if (mysqli_query($con, $sql)) {
//                         // echo "Employee marked as absent.<br>";
//                     } else {
//                         echo "Error: " . $sql . "<br>" . mysqli_error($con);
//                     }
//                 }
//                 continue; // Skip to next employee
//             }

//             // Convert to Unix timestamp only if not absent
//             $time_in = strtotime($time_in);
//             $time_out = strtotime($time_out);

//             // Round time_in to 8:00:00 if before 8:15:00
//             if (date('H:i:s', $time_in) < '08:11:00') {
//                 $time_in = strtotime(date('Y-m-d 08:00:00', $time_in));
//             }

//             // Round time_out to 16:00:00 if after 16:00:00
//             if (date('H:i:s', $time_out) > '16:00:00') {
//                 $time_out = strtotime(date('Y-m-d 16:00:00', $time_out));
//             }

//             // Calculate time difference in seconds
//             $time_difference = $time_out - $time_in;

//             // Calculate whole hours worked
//             $hours = floor($time_difference / 3600); // Whole hours
            
//             // Calculate remaining seconds after subtracting whole hours
//             $remaining_minutes = ($time_difference % 3600) / 60;

//             // If remaining minutes are more than 30, add 0.5 hours
//             if ($remaining_minutes > 30) {
//                 $hours += 0.5;
//             }
            
//             // Calculate late hours (minimum 0, maximum 8)
//             $late_hours = max(0, 8 - $hours);
            
//             if($status != '1'){
//                 $sql = "UPDATE payroll_time 
//                 SET `status` = '1', `totalhours` = '$hours', `name` = '$account_name', `latehours` = '$late_hours'
//                 WHERE `time_id` = '$timeid'";
//                 if (mysqli_query($con, $sql)) {
//                     // echo "Data inserted into payroll_time table successfully.<br>";
//                 } else {
//                     echo "Error: " . $sql . "<br>" . mysqli_error($con);
//                 }
//             }    
//         }

//     } else {
//         echo "No records found for the specified criteria.";
//     }
// } else {
//     echo "Error: " . $sql . "<br>" . mysqli_error($con);
// }
?>