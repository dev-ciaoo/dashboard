<?php
include('connection.php');

date_default_timezone_set('Asia/Manila');
        $dateToday = date("Y-m-d");
        $sqlAbsent = "SELECT * FROM `leavetbl`
                        WHERE iBranch = '" . $_SESSION['address'] . "'
                        AND dateFrom = '$dateToday'
                        AND user_Id IN (37, 10, 12, 15, 17, 25, 30, 48)"; // 71, 73, 75, 77, 79, 81, 83
        $queryAbsent = mysqli_query($con, $sqlAbsent);
        $rowFetch = mysqli_fetch_assoc($queryAbsent);
        // print_r(mysqli_fetch_assoc($queryAbsent));
        /* IF BM is ABSENT */
        if($rowFetch['iAbsent'] == 1 && $rowFetch['dateFrom'] == $dateToday && $rowFetch['iStatus'] == 2){
                if($_SESSION['position'] == 'Head' || $_SESSION['position'] == 'BM' || $_SESSION['position'] == 'GM' 
                        || $_SESSION['position'] == 'AGM' || $_SESSION['bankposition'] == 'Developer' 
                        || $_SESSION['bankposition'] == 'Branch Cashier') {

                        if($_SESSION['position'] == 'Head') {
                                if($_SESSION['username'] == 'jcvillanueva'){
                                        $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                                                JOIN `department` as d  ON d.id = a.userDepartment
                                                JOIN `leavetbl` as l ON l.user_Id = a.userId
                                                WHERE d.id = '". $_SESSION['department'] ."'
                                                AND a.userId <> '" . $_SESSION['userid'] . "'
                                                AND l.iStatus = 1";

                                        // $sql = "
                                        //         SELECT d.departmentName, l.*
                                        //         FROM `accounts` AS a
                                        //         JOIN `department` AS d ON d.id = a.userDepartment
                                        //         JOIN `leavetbl` AS l ON l.user_Id = a.userId
                                        //         WHERE 
                                        //         (
                                        //         (
                                        //                 l.iStatus = 1 
                                        //                 AND a.userPosition <> 'Staff'
                                        //                 AND a.userId <> '" . $_SESSION['userid'] . "'
                                        //         )
                                        //         OR
                                        //         (
                                        //                 l.iStatus = 1
                                        //                 AND d.id = '" . $_SESSION['department'] . "'
                                        //                 AND a.userId <> '" . $_SESSION['userid'] . "'
                                        //         )
                                        //         )";


                                // }else if($_SESSION['username'] == 'pnerona') {
                                //          $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                                //                         JOIN `department` as d ON d.id = a.userDepartment
                                //                         JOIN `leavetbl` as l ON l.user_Id = a.userId
                                //                         WHERE l.iStatus = 1 
                                //                                 AND a.userPosition <> 'Staff'
                                //                                 AND a.userId <> '" . $_SESSION['userid'] . "' ";
                                }else if($_SESSION['username'] == 'jbquijano') {
                                        $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                                                                JOIN `department` as d ON d.id = a.userDepartment
                                                                JOIN `leavetbl` as l ON l.user_Id = a.userId
                                                                WHERE l.iStatus = 1 
                                                                        AND d.id IN (3, 4)
                                                                        AND a.userPosition = 'Staff'
                                                ";
                                }else{
                                        $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                                                JOIN `department` as d  ON d.id = a.userDepartment
                                                JOIN `leavetbl` as l ON l.user_Id = a.userId
                                                WHERE d.id = '". $_SESSION['department'] ."'
                                                AND a.userId <> '" . $_SESSION['userid'] . "'
                                                AND l.iStatus = 1";
                                }
                                
                        }
                        if($_SESSION['position'] == 'BM') {
                                // if($_SESSION['username'] !== 'mruazol'){
                                         $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                                                JOIN `department` as d  ON d.id = a.userDepartment
                                                JOIN `leavetbl` as l ON l.user_Id = a.userId
                                                WHERE d.id = '". $_SESSION['department'] ."'
                                                        AND l.iStatus = 1";
                                // }else{
                                //         $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                                //                 JOIN `department` as d  ON d.id = a.userDepartment
                                //                 JOIN `leavetbl` as l ON l.user_Id = a.userId
                                //                 WHERE d.id IN (12, 14)
                                //                         AND l.iStatus = 1";
                                // }
                       
                        }
                        if($_SESSION['bankposition'] == 'Branch Cashier'){
                        $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                                        JOIN `department` as d  ON d.id = a.userDepartment
                                        JOIN `leavetbl` as l ON l.user_Id = a.userId
                                        WHERE d.id = '". $_SESSION['department'] ."'
                                        AND l.iStatus = 1 ";
                        }
                        if($_SESSION['position'] == 'GM'){
                        $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                                JOIN `department` as d ON d.id = a.userDepartment
                                JOIN `leavetbl` as l ON l.user_Id = a.userId
                                WHERE (
                                                (l.iStatus = 1 AND a.userPosition <> 'Staff') 
                                                OR 
                                                (l.iStatus = 4 AND a.userPosition = 'Staff')
                                                OR
                                                (l.iStatus = 1 AND a.userPosition = 'Staff' AND a.userName = 'jlcvalero')
                                        )
                                AND a.userId <> '" . $_SESSION['userid'] . "' ";
                        }
                        if($_SESSION['position'] == 'AGM'){
                        $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                                JOIN `department` as d ON d.id = a.userDepartment
                                JOIN `leavetbl` as l ON l.user_Id = a.userId
                                WHERE l.iStatus = 1 
                                AND a.userPosition <> 'Staff'
                                AND a.userId <> '" . $_SESSION['userid'] . "' ";
                        }
                        if($_SESSION['bankposition'] == 'Developer'){
                        $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                                JOIN `department` as d ON d.id = a.userDepartment
                                JOIN `leavetbl` as l ON l.user_Id = a.userId
                                WHERE l.iStatus = 1";
                        }
                }
        }else{
                if(!empty($rowFetch) || empty($rowFetch)){
                        if($_SESSION['position'] == 'Head' || $_SESSION['position'] == 'BM' || $_SESSION['position'] == 'GM' 
                          || $_SESSION['position'] == 'AGM' || $_SESSION['bankposition'] == 'Developer') {
                                if($_SESSION['position'] == 'Head') {
                                        if($_SESSION['username'] == 'jcvillanueva'){
                                                $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                                                        JOIN `department` as d  ON d.id = a.userDepartment
                                                        JOIN `leavetbl` as l ON l.user_Id = a.userId
                                                        WHERE d.id = '". $_SESSION['department'] ."'
                                                        AND a.userId <> '" . $_SESSION['userid'] . "'
                                                        AND l.iStatus = 1";

                                                // $sql = "
                                                //         SELECT d.departmentName, l.*
                                                //         FROM `accounts` AS a
                                                //         JOIN `department` AS d ON d.id = a.userDepartment
                                                //         JOIN `leavetbl` AS l ON l.user_Id = a.userId
                                                //         WHERE 
                                                //         (
                                                //         (
                                                //                 l.iStatus = 1 
                                                //                 AND a.userPosition <> 'Staff'
                                                //                 AND a.userId <> '" . $_SESSION['userid'] . "'
                                                //         )
                                                //         OR
                                                //         (
                                                //                 l.iStatus = 1
                                                //                 AND d.id = '" . $_SESSION['department'] . "'
                                                //                 AND a.userId <> '" . $_SESSION['userid'] . "'
                                                //         )
                                                //         )";


                                        // }else if($_SESSION['username'] == 'pnerona') {
                                        //  $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                                        //                 JOIN `department` as d ON d.id = a.userDepartment
                                        //                 JOIN `leavetbl` as l ON l.user_Id = a.userId
                                        //                 WHERE l.iStatus = 1 
                                        //                         AND a.userPosition <> 'Staff'
                                        //                         AND a.userId <> '" . $_SESSION['userid'] . "' ";
                                        }else if($_SESSION['username'] == 'jbquijano') {
                                        $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                                                                JOIN `department` as d ON d.id = a.userDepartment
                                                                JOIN `leavetbl` as l ON l.user_Id = a.userId
                                                                WHERE l.iStatus = 1 
                                                                        AND d.id IN (3, 4)
                                                                        AND a.userPosition = 'Staff'
                                                ";
                                        }else{
                                                $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                                                        JOIN `department` as d  ON d.id = a.userDepartment
                                                        JOIN `leavetbl` as l ON l.user_Id = a.userId
                                                        WHERE d.id = '". $_SESSION['department'] ."'
                                                        AND a.userId <> '" . $_SESSION['userid'] . "'
                                                        AND l.iStatus = 1";
                                        }
                                }
                                if($_SESSION['position'] == 'BM') {
                                        // if($_SESSION['username'] !== 'mruazol'){
                                        $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                                                JOIN `department` as d  ON d.id = a.userDepartment
                                                JOIN `leavetbl` as l ON l.user_Id = a.userId
                                                WHERE d.id = '". $_SESSION['department'] ."'
                                                        AND l.iStatus = 1";
                                        // }else{
                                        //         $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                                        //                 JOIN `department` as d  ON d.id = a.userDepartment
                                        //                 JOIN `leavetbl` as l ON l.user_Id = a.userId
                                        //                 WHERE d.id IN (12, 14)
                                        //                         AND l.iStatus = 1";
                                        // }
                                }
                                if($_SESSION['position'] == 'GM'){
                                $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                                        JOIN `department` as d ON d.id = a.userDepartment
                                        JOIN `leavetbl` as l ON l.user_Id = a.userId
                                        WHERE   (
                                                        (l.iStatus = 1 AND a.userPosition <> 'Staff') 
                                                        OR 
                                                        (l.iStatus = 4 AND a.userPosition = 'Staff')
                                                        OR
                                                        (l.iStatus = 1 AND a.userPosition = 'Staff' AND a.userName = 'jlcvalero')
                                                )
                                                AND a.userId <> '" . $_SESSION['userid'] . "' ";
                                }
                                if($_SESSION['position'] == 'AGM'){
                                $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                                        JOIN `department` as d ON d.id = a.userDepartment
                                        JOIN `leavetbl` as l ON l.user_Id = a.userId
                                        WHERE (
                                                (l.iStatus = 1 AND a.userPosition <> 'Staff') 
                                                OR 
                                                (l.iStatus = 4 AND a.userPosition = 'Staff')
                                                OR
                                                (l.iStatus = 1 AND a.userPosition = 'Staff' AND a.userName = 'jlcvalero')
                                        )
                                        AND a.userId <> '" . $_SESSION['userid'] . "' ";
                                }
                                if($_SESSION['bankposition'] == 'Developer'){
                                $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                                        JOIN `department` as d ON d.id = a.userDepartment
                                        JOIN `leavetbl` as l ON l.user_Id = a.userId
                                        WHERE l.iStatus = 1";
                                }
                        }
                }
        }
        

// $selectText = "SELECT * from chatbox ORDER BY id DESC";
$queryText = mysqli_query($con, $sql);
$rowNotif = mysqli_num_rows($queryText);

if($rowNotif >= 1){
    echo '<span id="notificationCount7" style="font-size: 10px; height: 15px; width: 10px; border-radius: 25%; text-align: center;">' . $rowNotif . '</span>';
}else{
    echo '<span id="notificationCount7 style="color: white;""></span>';
}

// Close database connection
mysqli_close($con);
?>

