<?php
if($_SESSION['position'] == 'Head'){
    if($_SESSION['username'] == 'jbquijano'){
        $sql_count = "SELECT d.departmentName, l.* FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                WHERE d.id IN (3, 6)
                AND l.iStatus = 1 AND a.userPosition = 'Staff'";
    }else{
        $sql_count = "SELECT d.departmentName, l.* FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                WHERE d.id = '". $_SESSION['department'] ."'
                AND l.iStatus = 1 AND a.userPosition = 'Staff'";
    }
}   
if($_SESSION['position'] == 'BM'){
    $sql_count = "SELECT d.departmentName, l.* FROM `accounts` as a 
                JOIN `department` as d  ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                WHERE d.id = '". $_SESSION['department'] ."'
                AND l.iStatus = 1 AND a.userPosition = 'Staff'";
}   
else if($_SESSION['position'] == 'GM'){
    $sql_count = "SELECT d.departmentName, l.* FROM `accounts` as a
                JOIN `department` as d ON d.id = a.userDepartment
                JOIN `leavetbl` as l ON l.user_Id = a.userId
                AND l.iStatus = 1 AND a.userPosition = 'Head'";
}
$query_count = mysqli_query($con, $sql_count);
$query_count->num_rows;
?>