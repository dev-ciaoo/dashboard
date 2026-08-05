<?php
include('connection.php');

date_default_timezone_set('Asia/Manila');
        $dateToday2 = date("Y-m-d");
        $sqlAbsent2 = "SELECT * FROM `leavetbl`
                        WHERE iBranch = '" . $_SESSION['address'] . "'
                        AND dateFrom = '$dateToday2'
                        AND user_Id IN (9, 10, 12, 15, 17, 25, 30)"; // 71, 73, 75, 77, 79, 81, 83
        $queryAbsent2 = mysqli_query($con, $sqlAbsent2);
        $rowFetch2 = mysqli_fetch_assoc($queryAbsent2);
        if($rowFetch2['iAbsent'] == 1 && $rowFetch2['dateFrom'] == $dateToday2 && $rowFetch2['iStatus'] == 2){
          if ($_SESSION['bankposition'] == 'BM-Noveleta' || $_SESSION['bankposition'] == 'BM-Tejero' || $_SESSION['bankposition'] == 'BM-Poblacion'
              || $_SESSION['bankposition'] == 'BM-Manggahan' || $_SESSION['bankposition'] == 'BM-Magallanes' || $_SESSION['bankposition'] == 'BM-Maragondon' 
              || $_SESSION['bankposition'] == 'BM-Ternate' || $_SESSION['bankposition'] == 'HR Officer' || $_SESSION['bankposition'] == 'LOAN Officer'
              || $_SESSION['bankposition'] == 'ROPOA Officer' || $_SESSION['bankposition'] == 'Accounting Officer' || $_SESSION['bankposition'] == 'LOAN Docu. Officer'
              || $_SESSION['bankposition'] == 'Credit Officer' || $_SESSION['bankposition'] == 'Compliance Officer' || $_SESSION['bankposition'] == 'Internal Auditor'
              || $_SESSION['bankposition'] == 'Developer' || $_SESSION['bankposition'] == 'Branch Cashier' || $_SESSION['bankposition'] == 'Credit Risk' || $_SESSION['bankposition'] == 'Collection Officer'
              || $_SESSION['bankposition'] == 'Credit Manager') {

                if($_SESSION['bankposition'] == 'Developer'){
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                        JOIN `department` as d  ON d.id = a.userDepartment
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3)";
                }

                if($_SESSION['bankposition'] == 'BM-Noveleta') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                            JOIN `department` as d  ON d.id = a.userDepartment
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE d.id = '". $_SESSION['department'] ."'
                            AND a.address = '" . $_SESSION['address'] . "'
                            AND r.r_Status IN (0, 3)";
                }

                if($_SESSION['bankposition'] == 'BM-Tejero') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                            JOIN `department` as d  ON d.id = a.userDepartment
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE d.id = '". $_SESSION['department'] ."'
                            AND a.address = '" . $_SESSION['address'] . "'
                            AND r.r_Status IN (0, 3)";
                }

                if($_SESSION['bankposition'] == 'BM-Poblacion') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                            JOIN `department` as d  ON d.id = a.userDepartment
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE d.id = '". $_SESSION['department'] ."'
                            AND a.address = '" . $_SESSION['address'] . "'
                            AND r.r_Status IN (0, 3)";
                }

                if($_SESSION['bankposition'] == 'BM-Manggahan') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                            JOIN `department` as d  ON d.id = a.userDepartment
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE d.id = '". $_SESSION['department'] ."'
                            AND a.address = '" . $_SESSION['address'] . "'
                            AND r.r_Status IN (0, 3)";
                }

                if($_SESSION['bankposition'] == 'BM-Magallanes') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                            JOIN `department` as d  ON d.id = a.userDepartment
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE d.id = '". $_SESSION['department'] ."'
                            AND a.address = '" . $_SESSION['address'] . "'
                            AND r.r_Status IN (0, 3)";
                            
                }

                if($_SESSION['bankposition'] == 'BM-Maragondon') {
                        // if($_SESSION['username'] !== 'mruazol'){
                                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                                                JOIN `department` as d  ON d.id = a.userDepartment
                                                JOIN `request` as r ON r.r_user_Id = a.userId
                                                WHERE d.id = '". $_SESSION['department'] ."'
                                                AND a.address = '" . $_SESSION['address'] . "'
                                                AND r.r_Status IN (0, 3)";
                        // }else{
                        //         $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                        //                         JOIN `department` as d  ON d.id = a.userDepartment
                        //                         JOIN `request` as r ON r.r_user_Id = a.userId
                        //                         WHERE d.id IN (12, 14)
                        //                         AND a.address IN ('Maragondon', 'Ternate')
                        //                         AND r.r_Status IN (0, 3)";
                        // }
                
                }

                if($_SESSION['bankposition'] == 'BM-Ternate') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                            JOIN `department` as d  ON d.id = a.userDepartment
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE d.id = '". $_SESSION['department'] ."'
                            AND a.address = '" . $_SESSION['address'] . "'
                            AND r.r_Status IN (0, 3)";
                }

                if($_SESSION['bankposition'] == 'Branch Cashier') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                            JOIN `department` as d  ON d.id = a.userDepartment
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE d.id = '". $_SESSION['department'] ."'
                            AND a.address = '" . $_SESSION['address'] . "'
                            AND a.bankPosition <> 'Branch Cashier'
                            AND r.r_Status IN (0, 3)";
                }

                if($_SESSION['department'] == 2) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                }
                if($_SESSION['department'] == 3) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment IN (3, 4, 6)";
                }
                if($_SESSION['department'] == 4) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                }
                if($_SESSION['department'] == 5) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                }
                if($_SESSION['department'] == 6) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0,3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                }
                if($_SESSION['department'] == 7) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                }
                if($_SESSION['department'] == 17) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                }
                if($_SESSION['department'] == 18) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                }
                if($_SESSION['department'] == 19) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                }
                if($_SESSION['department'] == 20) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                }
                 if($_SESSION['department'] == 21) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                }
                 if($_SESSION['department'] == 23) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                }
            } 
        }else{
            if(!empty($rowFetch2) || empty($rowFetch2)){
                if ($_SESSION['bankposition'] == 'BM-Noveleta' || $_SESSION['bankposition'] == 'BM-Tejero' || $_SESSION['bankposition'] == 'BM-Poblacion'
                    || $_SESSION['bankposition'] == 'BM-Manggahan' || $_SESSION['bankposition'] == 'BM-Magallanes' || $_SESSION['bankposition'] == 'BM-Maragondon' 
                    || $_SESSION['bankposition'] == 'BM-Ternate' || $_SESSION['bankposition'] == 'HR Officer' || $_SESSION['bankposition'] == 'LOAN Officer'
                    || $_SESSION['bankposition'] == 'ROPOA Officer' || $_SESSION['bankposition'] == 'Accounting Officer' || $_SESSION['bankposition'] == 'LOAN Docu. Officer'
                    || $_SESSION['bankposition'] == 'Credit Officer' || $_SESSION['bankposition'] == 'Compliance Officer' || $_SESSION['bankposition'] == 'Internal Auditor'
                    || $_SESSION['bankposition'] == 'Developer' || $_SESSION['bankposition'] == 'Credit Risk' || $_SESSION['bankposition'] == 'Collection Officer'
                    || $_SESSION['bankposition'] == 'Credit Manager') {
    
                  if($_SESSION['bankposition'] == 'Developer'){
                    $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                            JOIN `department` as d  ON d.id = a.userDepartment
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE r.r_Status IN (0, 3)";
                  }
    
                  if($_SESSION['bankposition'] == 'BM-Noveleta') {
                    $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                              JOIN `department` as d  ON d.id = a.userDepartment
                              JOIN `request` as r ON r.r_user_Id = a.userId
                              WHERE d.id = '". $_SESSION['department'] ."'
                              AND a.address = '" . $_SESSION['address'] . "'
                              AND r.r_Status IN (0, 3)";
                  }
    
                  if($_SESSION['bankposition'] == 'BM-Tejero') {
                    $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                              JOIN `department` as d  ON d.id = a.userDepartment
                              JOIN `request` as r ON r.r_user_Id = a.userId
                              WHERE d.id = '". $_SESSION['department'] ."'
                              AND a.address = '" . $_SESSION['address'] . "'
                              AND r.r_Status IN (0, 3)";
                  }
    
                  if($_SESSION['bankposition'] == 'BM-Poblacion') {
                    $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                              JOIN `department` as d  ON d.id = a.userDepartment
                              JOIN `request` as r ON r.r_user_Id = a.userId
                              WHERE d.id = '". $_SESSION['department'] ."'
                              AND a.address = '" . $_SESSION['address'] . "'
                              AND r.r_Status IN (0, 3)";
                  }
    
                  if($_SESSION['bankposition'] == 'BM-Manggahan') {
                    $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                              JOIN `department` as d  ON d.id = a.userDepartment
                              JOIN `request` as r ON r.r_user_Id = a.userId
                              WHERE d.id = '". $_SESSION['department'] ."'
                              AND a.address = '" . $_SESSION['address'] . "'
                              AND r.r_Status IN (0, 3)";
                  }
    
                  if($_SESSION['bankposition'] == 'BM-Magallanes') {
                    $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                              JOIN `department` as d  ON d.id = a.userDepartment
                              JOIN `request` as r ON r.r_user_Id = a.userId
                              WHERE d.id = '". $_SESSION['department'] ."'
                              AND a.address = '" . $_SESSION['address'] . "'
                              AND r.r_Status IN (0, 3)";
                  }
    
                  if($_SESSION['bankposition'] == 'BM-Maragondon') {
                        // if($_SESSION['username'] !== 'mruazol'){
                                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                                                JOIN `department` as d  ON d.id = a.userDepartment
                                                JOIN `request` as r ON r.r_user_Id = a.userId
                                                WHERE d.id = '". $_SESSION['department'] ."'
                                                AND a.address = '" . $_SESSION['address'] . "'
                                                AND r.r_Status IN (0, 3)";
                        // }else{
                        //         $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                        //                         JOIN `department` as d  ON d.id = a.userDepartment
                        //                         JOIN `request` as r ON r.r_user_Id = a.userId
                        //                         WHERE d.id IN (12, 14)
                        //                         AND a.address IN ('Maragondon', 'Ternate')
                        //                         AND r.r_Status IN (0, 3)";
                        // }
                  }
    
                  if($_SESSION['bankposition'] == 'BM-Ternate') {
                    $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                              JOIN `department` as d  ON d.id = a.userDepartment
                              JOIN `request` as r ON r.r_user_Id = a.userId
                              WHERE d.id = '". $_SESSION['department'] ."'
                              AND a.address = '" . $_SESSION['address'] . "'
                              AND r.r_Status IN (0, 3)";
                  }
    
                  if($_SESSION['bankposition'] == 'Branch Cashier') {
                    $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                              JOIN `department` as d  ON d.id = a.userDepartment
                              JOIN `request` as r ON r.r_user_Id = a.userId
                              WHERE d.id = '". $_SESSION['department'] ."'
                              AND a.address = '" . $_SESSION['address'] . "'
                              AND r.r_Status IN (0, 3)";
                  }
    
                  if($_SESSION['department'] == 2) {
                    $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                  }
                  if($_SESSION['department'] == 3) {
                    $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE r.r_Status IN (0, 3) AND a.userDepartment IN (3, 4, 6)";
                  }
                  if($_SESSION['department'] == 4) {
                    $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                  }
                  if($_SESSION['department'] == 5) {
                    $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                  }
                  if($_SESSION['department'] == 6) {
                    $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE r.r_Status IN (0,3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                  }
                  if($_SESSION['department'] == 7) {
                    $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                  }
                  if($_SESSION['department'] == 17) {
                    $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                  }
                  if($_SESSION['department'] == 18) {
                    $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                  }
                  if($_SESSION['department'] == 19) {
                    $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                  }
                  if($_SESSION['department'] == 20) {
                    $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                  }
                  if($_SESSION['department'] == 21) {
                    $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                  }
                  if($_SESSION['department'] == 23) {
                    $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                            JOIN `request` as r ON r.r_user_Id = a.userId
                            WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
                  }
                }
            }
        }

// $selectText = "SELECT * from chatbox ORDER BY id DESC";
$queryText = mysqli_query($con, $sql2);
$rowNotif = mysqli_num_rows($queryText);

if($rowNotif >= 1){
    echo '<span id="notificationCount6" style="font-size: 10px; height: 15px; width: 10px; border-radius: 25%; text-align: center;">' . $rowNotif . '</span>';
}else{
    echo '<span id="notificationCount6 style="color: white;""></span>';
}

// Close database connection
mysqli_close($con);
?>

