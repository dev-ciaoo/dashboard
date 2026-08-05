<?php
include('connection.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data_to_retrieve = $_POST['data_to_retrieve'];
$startdate = isset($_POST['startdateoutput']) ? $_POST['startdateoutput'] : '';
$enddate = isset($_POST['enddateoutput']) ? $_POST['enddateoutput'] : ''; 
$empid = isset($_POST['empId']) ? $_POST['empId'] : '';

// Sanitize the dates if necessary
$startdate = mysqli_real_escape_string($con, $startdate);
$enddate = mysqli_real_escape_string($con, $enddate);
$empid = mysqli_real_escape_string($con, $empid);

$sql = "SELECT * FROM pay_earningshr 
        WHERE `employeeId` = $empid 
        ORDER BY id DESC 
        LIMIT 1";

$result = mysqli_query($con, $sql);

if ($result) {
    if(mysqli_num_rows($result) > 0) {
        // If there are rows returned
        $row = mysqli_fetch_assoc($result);

        $datemodified = $row['datemodified'];
        $MonthlySalary = $row['MonthlySalary'];
        $riceallowance = $row['RiceAllowance'];
        $tranpo = $row['TranspoAllowance'];
        $sss = $row['sss'];
        $sssmand = $row['sssmandprovident'];
        $pagibig = $row['pagibig'];
        $philhealth = $row['philhealth'];
        $tax = $row['withholdingtax'];
        $sssEmployer = $row['sssEmployer'];
        $sssmandEmployer = $row['sssmandEmployer'];
        $pagibigEmployer = $row['pagibigEmployer'];
        $philhealthEmployer = $row['philhealthEmployer'];
        $id = $row['employeeId'];

        if ($data_to_retrieve === 'basicsalary') {
            echo $MonthlySalary;
        } elseif ($data_to_retrieve === 'riceallowance') {
            echo $riceallowance;
        } elseif ($data_to_retrieve === 'transpo') {
            echo $tranpo;
        }else if ($data_to_retrieve === 'sss'){
            echo $sss;
        }else if ($data_to_retrieve === 'sssmand'){
            echo $sssmand;
        }else if ($data_to_retrieve === 'pagibig'){
            echo $pagibig;
        }else if ($data_to_retrieve === 'philhealth'){
            echo $philhealth;
        } else if ($data_to_retrieve === 'tax'){
            echo $tax;
        }else if ($data_to_retrieve === 'sssEmployer'){
            echo $sssEmployer;
        }else if ($data_to_retrieve === 'sssmandEmployer'){
            echo $sssmandEmployer;
        }else if ($data_to_retrieve === 'pagibigEmployer'){
            echo $pagibigEmployer;
        }else if ($data_to_retrieve === 'philhealthEmployer'){
            echo $philhealthEmployer;
        }                                            
               
    } else {
        // If result is null, execute another query
        $secondSql = "SELECT * FROM pay_earningshr WHERE `employeeId` = $empid ORDER BY id DESC LIMIT 1";
        $secondResult = mysqli_query($con, $secondSql);
      
        if($secondResult) {
            $row1 = mysqli_fetch_assoc($secondResult);

            if($row1) {
                $datemodified = $row1['datemodified'];
                $MonthlySalary = $row1['MonthlySalary'];
                $riceallowance = $row1['RiceAllowance'];
                $tranpo = $row1['TranspoAllowance'];
                $sss = $row1['sss'];
                $sssmand = $row1['sssmandprovident'];
                $pagibig = $row1['pagibig'];
                $philhealth = $row1['philhealth'];
                $sssEmployer = $row1['sssEmployer'];
                $sssmandEmployer = $row1['sssmandEmployer'];
                $pagibigEmployer = $row1['pagibigEmployer'];
                $philhealthEmployer = $row1['philhealthEmployer'];
                $tax = $row1['withholdingtax'];
        
                $id = $row1['employeeId'];
            } else {
                // If row is null, set variables to 0
                $MonthlySalary = 0;
                $riceallowance = 0;
                $tranpo = 0;
                $sss = 0;
                $sssmand = 0;
                $pagibig = 0;
                $philhealth = 0;
                $tax = 0;
                $sssEmployer = 0;
                $sssmandEmployer = 0;
                $pagibigEmployer = 0;
                $philhealthEmployer = 0;
                       
            }

            if ($data_to_retrieve === 'basicsalary') {
                echo $MonthlySalary;
            } elseif ($data_to_retrieve === 'riceallowance') {
                echo $riceallowance;
            } elseif ($data_to_retrieve === 'transpo') {
                echo $tranpo;
            }else if ($data_to_retrieve === 'sss'){
                echo $sss;
            }else if ($data_to_retrieve === 'sssmand'){
                echo $sssmand;
            }else if ($data_to_retrieve === 'pagibig'){
                echo $pagibig;
            }else if ($data_to_retrieve === 'philhealth'){
                echo $philhealth;
            } else if ($data_to_retrieve === 'tax'){
                echo $tax;
            }else if ($data_to_retrieve === 'sssEmployer'){
                echo $sssEmployer;
            }else if ($data_to_retrieve === 'sssmandEmployer'){
                echo $sssmandEmployer;
            }else if ($data_to_retrieve === 'pagibigEmployer'){
                echo $pagibigEmployer;
            }else if ($data_to_retrieve === 'philhealthEmployer'){
                echo $philhealthEmployer;
            }                                
        } else {
            echo "no record";   
        }
    }
}

mysqli_close($con);
?>
