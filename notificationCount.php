<?php
include('connection.php');

if($_SESSION['position'] == 'Head'){
    $sql_count = "SELECT d.departmentName, l.* FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                WHERE d.id = '". $_SESSION['department'] ."'
                AND l.iStatus = 1 AND a.userPosition = 'Staff'";
}

if($_SESSION['position'] == 'BM'){
    // if($_SESSION['username'] !== 'mruazol'){
        $sql_count = "SELECT d.*, l.* FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                WHERE d.id = '". $_SESSION['department'] ."'
                AND l.iStatus = 1 AND a.userPosition = 'Staff'";
    // }else{
    //     $sql_count = "SELECT d.*, l.* FROM `accounts` as a 
    //             JOIN `department` as d  ON d.id = a.userDepartment
    //             JOIN `leavetbl` as l ON l.user_Id = a.userId
    //             WHERE d.id IN (12, 14)
    //             AND l.iStatus = 1 AND a.userPosition = 'Staff'";
    // }
}   
else if($_SESSION['bankposition'] == 'Branch Cashier')  {
    $sql_count = "SELECT d.departmentName, l.* a.address FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                WHERE d.id = '". $_SESSION['department'] ."'
                AND l.iStatus = 1 AND a.userPosition = 'Staff'";
} 
else if($_SESSION['position'] == 'GM'){
    $sql_count = "SELECT d.departmentName, l.* FROM `accounts` as a
                JOIN `department` as d ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                AND l.iStatus = 1 AND a.userPosition <> 'Staff'";
}
else if($_SESSION['position'] == 'AGM'){
    $sql_count = "SELECT d.departmentName, l.* FROM `accounts` as a
                JOIN `department` as d ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                AND l.iStatus = 1 AND a.userPosition <> 'Staff'";
}
$query_count = mysqli_query($con, $sql_count);
$query_count->num_rows;
?>