<?php
include('connection.php');
include('fileupload.php');

ini_set('max_execution_time', 0);
ini_set('mysql.connect_timeout', 0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('Asia/Manila');
    $dateToday = date('F j, Y');
    
    $selectAll = "SELECT * FROM duecollection WHERE dateImported <> '$dateToday' ";
    $queryAll = mysqli_query($con, $selectAll);
    if(mysqli_num_rows($queryAll) > 0){
        while($roww = mysqli_fetch_assoc($queryAll)){
            $dID = $roww['duecLoanId'];
            $dBranch = $roww['duecBranch'];
            $dProdId = $roww['duecProdID'];
            $dBname = $roww['duecBName'];
            $dAddress = $roww['duecAddress'];
            $dContact = $roww['duecContact'];
            $dProdType = $roww['duecProdType'];
            $dStatus = $roww['duecStatus'];
            $dSec = $roww['duecSec'];
            $dLoanG = $roww['duecLoanG'];
            $dLoanM = $roww['duecLoanM'];
            $dDueDate = $roww['duecDueDate'];
            $dDLate = $roww['duecDLate'];
            $dPrincipalAmount = $roww['duecPrincipalAmount'];
            $dPrincipalBal = $roww['duecPrincipalBal'];
            $dPrincipalDue = $row['duecPrincipalDue'];
            $dInterest = $roww['duecInterest'];
            $dPenalty = $roww['duecPenalty'];
            $dTotalAmountDue = $roww['duecTotalAmountDue'];
            $dLastUnpaid = $roww['duecLastUnpaid'];
            $dDstatus = $roww['dStatus'];
            $dDateImported = $roww['dateImported'];

            // $formattedGiven = sprintf("%.2f", $dOverDue);
            // $formattedGiven2 = sprintf("%.2f", $dAccBal);
            $formattedGiven = number_format($dInterest, 2, '.', '');
            $formattedGiven2 = number_format($dPenalty, 2, '.', '');
            $formattedGiven3 = number_format($dPrincipalBal, 2, '.', '');
            $formattedGiven4 = number_format($dPrincipalDue, 2, '.', '');
            $formattedGiven5 = number_format($dInterest, 2, '.', '');
            $formattedGiven6 = number_format($dPenalty, 2, '.', '');
            $formattedGiven7 = number_format($dTotalAmountDue, 2, '.', '');

            # Insert 
     $sqlTrans = "INSERT INTO `collectionarchive` (`colLoanId`, `colBranch`, `colProdId`, `colBName`, `colAddress`,
                                            `colContact`, `colProdType`, `colStatus`, `colDueSec`,`colLoanG`, `colLoanM`,
                                            `colDueDate`, `colDueLate`, `colPrincipalAmount`, `colPrincipalBal`, `colPrincipalDue`,
                                            `colInterest`, `colPenalty`, `colTotalAmountDue`, `colLastUnpaid`, `coldStatus`, `coldateImported`)
                                    VALUES
                                            ('$dID', '$dBranch', '$dProdId', '$dBname', '$dAddress', 
                                            '$dContact', '$dProdType', '$dStatus', '$dSec', '$dLoanG', '$dLoanM', 
                                            '$dDueDate', '$dDLate', '$dPrincipalAmount', '$formattedGiven3', '$formattedGiven4',
                                            '$formattedGiven5', '$formattedGiven6', '$formattedGiven7', '$dLastUnpaid', '$dDstatus', '$dDateImported')";

     $queryTrans = mysqli_query($con, $sqlTrans);

        }
    }
    echo $dID;

    $targetDir = "dueCollection/"; // Directory to store uploaded files
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


            // $sumByProdID = [];
            // $sum2ByProdID = [];
            // Read the CSV data into an array
                
            foreach ($csvData as $data) {
                // Ensure that the array contains the expected number of columns
                if (count($data) != 19) {
                    echo "Invalid data format in CSV file.";
                    continue;
                }

                $duecBranch = $data[0];
                $duecProdID = $data[1];
                $duecBName = $data[2];
                $duecContact = $data[3];
                $duecProdType = $data[4];
                $duecStatus = $data[5];
                $duecSec = $data[6];
                $duecDueDate = $data[7];
                $duecDLate = $data[8];
                $duecPrincipalBal = $data[9];
                $duecPrincipalDue = $data[10];
                $duecInterest = $data[11];
                $duecPenalty = $data[12];
                $duecTotalAmountDue = $data[13];
                $duecLastUnpaid = $data[14];
                $duecAddress = mysqli_real_escape_string($con, $data[15]);
                $duecLoanG = $data[16];
                $duecLoanM = $data[17];
                $duecPrincipalAmount = $data[18];

                if($duecBranch == 'General Trias HQ'){
                    $duecBranch = 'Head Office';
                }
                // else{
                //     $duecBranch = $duecBranch;
                // }

                if($duecSec == 'secured'){
                    $duecSec = 'SECURED';
                }else{
                    $duecSec = 'UNSECURED';
                }
                
                $formatted_duecPrincipalBal = number_format($duecPrincipalBal, 2, '.', '');
                $formatted_duecPrincipalDue = number_format($duecPrincipalDue, 2, '.', '');
                $formatted_duecInterest = number_format($duecInterest, 2, '.', '');
                $formatted_duecPenalty = number_format($duecPenalty, 2, '.', '');
                $formatted_duecTotalAmountDue = number_format($duecTotalAmountDue, 2, '.', '');

                if($duecProdType == "Microfinance Loan"){
                    $duecProdType = "Microfinance";
                }

                if($duecProdType == "Employee Loan"){
                    $duecProdType = "Salary Loan";
                }


                // Check if the key exists in the array, if not, initialize it with 0
                // if (!isset($sumByProdID[$duecProdID])) {
                //     $sumByProdID[$duecProdID] = 0;
                // }

                // // Add the current value to the existing sum
                // $sumByProdID[$duecProdID] += $duecOverDue;

                // // Repeat the same steps for the second sum
                // if (!isset($sum2ByProdID[$duecProdID])) {
                //     $sum2ByProdID[$duecProdID] = 0;
                // }

                // $sum2ByProdID[$duecProdID] += $duecAccBal;

                // // // Loop through the first sum array and print the formatted results
                // foreach ($sumByProdID as $duecProdID => $sum) {
                // // Format the sum to 2 decimal places without rounding
                // $formattedSum = number_format($sum, 2, '.', '');
                // echo "Total SUM for duecProdID $duecProdID: $formattedSum\n";
                // }

                // // // Loop through the second sum array and print the formatted results
                // foreach ($sum2ByProdID as $duecProdID => $sum2) {
                // // Format the sum to 2 decimal places without rounding
                // $formattedSum2 = number_format($sum2, 2, '.', '');
                // echo "Total SUM for duecProdID $duecProdID: $formattedSum2\n";
                // }

                // // Initialize arrays to store the results
                // $maxDates = []; // Changed variable name for clarity
                // $minDates = []; // Changed variable name for clarity
                // $daysUntilToday = [];

                // // Loop through your data and update the maximum dates
                // foreach ($yourData as $duecProdID => $duecDueDate) {
                //     // Parse the due date into a DateTime object
                //     $duecDate = DateTime::createFromFormat('Y-m-d', $duecDueDate);

                //     // Check if the duecProdID is already in the minDates array
                //     if (isset($minDates[$duecProdID])) {
                //         // Compare the current date with the stored minimum date
                //         if ($duecDate < $minDates[$duecProdID]) {
                //             $minDates[$duecProdID] = $duecDate; // Update the minimum date
                //         }
                //     } else {
                //         // If the duecProdID is not in the array, add it with the current date
                //         $minDates[$duecProdID] = $duecDate;
                //     }
                // }

                // // Format and display the minimum dates
                // foreach ($minDates as $duecProdID => $minDate) {
                //     $minDateFormatted = $minDate->format('Y-m-d');
                //     echo "Minimum date for duecProdID $duecProdID is: $minDateFormatted\n";
                // }

                // // Calculate and display the number of days from the maxDueDate up to today for each duecProdID
                // $currentDate = new DateTime();
                // $daysUntilToday = array(); // Initialize the array to store differences

                // foreach ($minDates as $duecProdID => $maxDate) {
                //     if ($maxDate > $currentDate) {
                //         $interval = $currentDate->diff($maxDate);
                //         $duecDLate = 0; // Set to 0 if the difference is negative
                //     } else {
                //         $interval = $maxDate->diff($currentDate);
                //         $difference = $interval->days;
                //         $duecDLate = $difference < 0 ? 0 : $difference;
                //     }
                // }

                //              
                $parts = explode(', ', $duecBName);

                if (count($parts) >= 2) {
                    $firstWordAfterComma = trim($parts[1]);
                    $firstWordArray = explode(' ', $firstWordAfterComma);
                    $complete = $parts[0] . ", " . $firstWordArray[0];

                    $searchTermBits = array();
                    $complete = trim($complete);
                    $terms = explode(' ', $complete);

                    foreach ($terms as $term) {
                        $term = trim($term);
                        if (!empty($term)) {
                            $searchTermBits[] = "customerFullName LIKE ?";
                        } else {
                            echo 'ERROR bits ' . mysqli_error($con);
                        }
                    }
                    $sqlLoans = "SELECT customerFullName FROM loan WHERE " . implode(' AND ', $searchTermBits);
                    $stmtLoans = mysqli_prepare($con, $sqlLoans);

                    if ($stmtLoans) {
                        // Dynamically bind parameters for the prepared statement
                        $param = '%' . implode('%', $terms) . '%';
                        mysqli_stmt_bind_param($stmtLoans, str_repeat('s', count($terms)), ...array_fill(0, count($terms), $param));
                        mysqli_stmt_execute($stmtLoans);
                        mysqli_stmt_store_result($stmtLoans);

                        if (mysqli_stmt_num_rows($stmtLoans) > 0) {
                            // Data exists, update it
                            $sqlupd = "UPDATE loan SET customerFullName = ? WHERE " . implode(' AND ', $searchTermBits);
                            $stmtupd = mysqli_prepare($con, $sqlupd);

                            if ($stmtupd) {
                                mysqli_stmt_bind_param($stmtupd, str_repeat('s', count($terms) + 1), $duecBName, ...array_fill(0, count($terms), $param));
                                mysqli_stmt_execute($stmtupd);
                                echo 'Update successful!';
                            } else {
                                echo 'ERROR Update ' . mysqli_error($con);
                            }
                        } else {
                            // Data doesn't exist, insert it
                            $cons = "CONSOLIDATED DATA";
                            $sqlNew = "INSERT INTO `loan` (`customerFullName`, `salaryType`, `branch`, `loanType`, `dateCreated`) 
                                                    VALUES 
                                                            (?, ?, ?, ?, ?)";
                            $stmtNew = mysqli_prepare($con, $sqlNew);

                            if ($stmtNew) {
                                // $duecProdType = 'YourValue'; // Set your value for $duecProdType
                                // $dateToday = 'YourValue'; // Set your value for $dateToday

                                mysqli_stmt_bind_param($stmtNew, 'sssss', $duecBName, $duecProdType, $duecBranch, $duecSec, $dateToday);
                                mysqli_stmt_execute($stmtNew);
                                echo 'Insert successful!';
                            } else {
                                echo 'ERROR Insert ' . mysqli_error($con);
                            }
                        }
                    } else {
                        echo 'ERROR: Invalid format for $duecBName ' . mysqli_error($con);
                    }
                } else {
                    echo 'ERROR: Invalid format for $duecBName ' . mysqli_error($con);
                }
                $fName = $duecBName;
                    $parts = explode(', ', $fName);

                    if (count($parts) >= 2) {
                        $firstWordAfterComma = trim($parts[1]);
                        $firstWordArray = explode(' ', $firstWordAfterComma);
                        $complete = $parts[0] . ", " . $firstWordArray[0];

                        $searchTermBits = array();
                        $complete = trim($complete);
                        $terms = explode(' ', $complete);
                        
                        foreach ($terms as $term) {
                            $term = trim($term);
                            if (!empty($term)) {
                                $searchTermBits[] = " customerFullName LIKE '%$term%' ";
                            } else {
                                echo 'ERROR bits ' . mysqli_error($con);
                            }
                        }
                        $sqlLoans = "SELECT customerFullName FROM loan WHERE ".implode(' AND ', $searchTermBits)." ";
                        $queryLoans = mysqli_query($con, $sqlLoans);
                        if($queryLoans == true){
                            $selectLoans = mysqli_fetch_assoc($queryLoans);
                                $selectLoansFullName = $selectLoans['customerFullName'];
                        }
                        if(mysqli_num_rows($queryLoans) > 0){
                            $thisTerm = $term;
                            $try2 = stripos($selectLoansFullName, $thisTerm);
                            if($try2 === true){
                                if($duecBranch == 'General Trias HQ'){
                                    $duecBranch = 'Head Office';
                                }
                                $sqlupd = "UPDATE loan SET customerFullName = '$duecBName'
                                                            -- branch = '$duecBranch' 
                                                            WHERE ".implode(' AND ', $searchTermBits)."";
                                $queryupd = mysqli_query($con, $sqlupd);
                                continue;
                            }
                        }else{
                            $cons = "CONSOLIDATED DATA";
                            if($duecBranch == 'General Trias HQ'){
                                $duecBranch = 'Head Office';
                            }
                            $sqlNew = "INSERT INTO `loan` (`customerFullName`, `salaryType`, `branch`, `loanType`, `dateCreated`) 
                                                VALUES
                                                            ('$duecBName', '$duecProdType', '$duecBranch', '$duecSec', '$dateToday')"; //dito ko nagbago
                            $queryNew = mysqli_query($con, $sqlNew);
                            $lastId = mysqli_insert_id($con);
                            if($queryNew == true){
                                echo 'SUCCESS!';
                            }else{
                                echo 'ERROR Insert'. mysqli_error($con);
                            }
                        }
                    }else {
                        echo 'ERROR: Invalid format for $duecBName'. mysqli_error($con);
                    }
                    
                // 
                // Check if the record already exists
                $sqlSelect = "SELECT * FROM `duecollection` WHERE `duecProdID` = '$duecProdID'";
                $querySelect = mysqli_query($con, $sqlSelect);
                if($querySelect == true){
                    $dataC = mysqli_fetch_assoc($querySelect);
                        $duecId = $dataC['duecLoanId'];
                        $branch = $dataC['duecBranch'];
                        $prodId = $dataC['duecProdID'];
                        $bName = $dataC['duecBName'];
                        $address = $dataC['duecAddress'];
                        $contact = $dataC['duecContact'];
                        $status = $dataC['duecStatus'];
                        $prodType = $dataC['duecProdType'];
                        $sec = $dataC['duecSec'];
                        $loanGranted = $dataC['duecLoanG'];
                        $loanMaturity = $dataC['duecLoanM'];
                        $dueDate = $dataC['duecDueDate'];
                        $dLate = $dataC['duecDLate'];
                        $principalAmount = (float)$dataC['duecPrincipalAmount'];
                        $principalBal = (float)$dataC['duecPrincipalBal'];
                        $principalDue = (float)$dataC['duecPrincipalDue'];
                        $interest = (float)$dataC['duecInterest'];
                        $penalty = (float)$dataC['duecPenalty'];
                        $totalAmountDue = (float)$dataC['duecTotalAmountDue'];
                        $lastUnpaid = $dataC['duecLastUnpaid'];
                        $dStats = $dataC['dStatus'];
                        $dateImported = $dataC['dateImported'];
                        
                }
                if (mysqli_num_rows($querySelect) > 0) {

                    // Data already exists, perform an UPDATE query
                    $sqlUpdate = "UPDATE `duecollection` SET
                                                            `duecBranch` = '$duecBranch',
                                                            `duecBName` = '$duecBName',
                                                            `duecAddress` = '$duecAddress',
                                                            `duecContact` = '$duecContact',
                                                            `duecStatus` = '$duecStatus',
                                                            `duecProdType` = '$duecProdType',
                                                            `duecSec` = '$duecSec',
                                                            `duecLoanG` = '$duecLoanG',
                                                            `duecLoanM` = '$duecLoanM',
                                                            `duecDueDate` = '$duecDueDate',
                                                            `duecDLate` = '$duecDLate',
                                                            `duecPrincipalAmount` = '$duecPrincipalAmount',
                                                            `duecPrincipalBal` = '$formatted_duecPrincipalBal',
                                                            `duecPrincipalDue` = '$formatted_duecPrincipalDue',
                                                            `duecInterest` = '$formatted_duecInterest',
                                                            `duecPenalty` = '$formatted_duecPenalty',
                                                            `duecTotalAmountDue` = '$formatted_duecTotalAmountDue',
                                                            `duecLastUnpaid` = '$duecLastUnpaid',
                                                            `dateImported` = '$dateToday'
                                                                WHERE `duecProdID` = '$duecProdID'";

                    $queryUpdate = mysqli_query($con, $sqlUpdate);

                    if ($queryUpdate) {
                        echo "Update Successfully.";
            
                        // Update the letterStatus in the loan database based on your conditions
                        if ($duecDLate <= 30) {
                            $letterStatus = 0;
                        } elseif ($duecDLate >= 31 && $duecDLate <= 60) {
                            $letterStatus = 1;
                        } elseif ($duecDLate >= 61 && $duecDLate <= 90) {
                            $letterStatus = 2;
                        } elseif ($duecDLate >= 91 && $duecDLate <= 105) {
                            $letterStatus = 3;
                        } else {
                            $letterStatus = 4;
                        }
                        
                        if($duecBranch == 'General Trias HQ'){
                            $duecBranch = 'Head Office';
                        }
                        // Update the letterStatus in the loan table #put this to query ,`letterStatus` = '$letterStatus'
                        $updateStatusQuery = "UPDATE `loan` SET 
                                                                -- `branch` = '$duecBranch', 
                                                                `productID` = '$prodId', 
                                                                `letterStatus` = '$letterStatus' 
                                                                            WHERE `loan_Id` = '$duecId'"; //nagbago din ako dto branch
                        $queryUpdateStatus = mysqli_query($con, $updateStatusQuery);
            
                        if ($queryUpdateStatus) {   
                            echo "Letter Status updated in the loan database.";
                        } else {
                            echo "Failed to update Letter Status in the loan database: " . mysqli_error($con);
                        }
                    } else {
                        echo "Update query failed: " . mysqli_error($con);
                    }

                    $deleteQuery = "DELETE FROM `duecollection` WHERE dateImported <> '$dateToday'";
                    $deleteResult = mysqli_query($con, $deleteQuery);
                    if (!$deleteResult) {
                        echo "Delete query failed: " . mysqli_error($con);
                    }
                }else {
                    // Data doesn't exist, perform an INSERT query
                    $sqlInsert = "INSERT INTO `duecollection` (`duecBranch`, `duecProdID`, `duecBName`, `duecAddress`,
                                                                `duecContact`, `duecStatus`, `duecProdType`, `duecSec`, `duecLoanG`, 
                                                                `duecLoanM`, `duecDueDate`, `duecDLate`, `duecPrincipalAmount`, 
                                                                `duecPrincipalBal`, `duecPrincipalDue`, `duecInterest`, 
                                                                `duecPenalty`, `duecTotalAmountDue`, `duecLastUnpaid`, `dateImported`)
                                                        VALUES 
                                                                ('$duecBranch', '$duecProdID', '$duecBName', '$duecAddress',
                                                                '$duecContact', '$duecStatus', '$duecProdType', '$duecSec', '$duecLoanG', 
                                                                '$duecLoanM', '$duecDueDate', '$duecDLate', '$duecPrincipalAmount',
                                                                '$formatted_duecPrincipalBal', '$formatted_duecPrincipalDue', '$formatted_duecInterest', 
                                                                '$formatted_duecPenalty', '$formatted_duecTotalAmountDue', '$duecLastUnpaid', '$dateToday')";

                    $queryInsert = mysqli_query($con, $sqlInsert);

                    if (!$queryInsert) {
                        echo "Insert query failed." . mysqli_error($con);
                    }else{
                        $selectLoan = "SELECT l.loan_Id, l.customerFullName, l.loanType, l.branch
                                                        FROM loan AS l
                                                        JOIN duecollection AS d ON d.duecBName = l.customerFullName
                                                        WHERE l.customerFullName = d.duecBName";

                    $queryLoan = mysqli_query($con, $selectLoan);

                    if (mysqli_num_rows($queryLoan) > 0) {
                        $loanData = [];

                        while ($row = mysqli_fetch_assoc($queryLoan)) {
                            $loanData[$row['customerFullName']][] = $row; // Group data by customerFullName
                        }

                        foreach ($loanData as $customerName => $loans) {
                            if (count($loans) > 1) {
                                // More than one loan, prioritize CONSOLIDATED DATA
                                $selectedLoan = null;
                                foreach ($loans as $loan) {
                                    if ($loan['loanType'] === 'CONSOLIDATED DATA') {
                                        $selectedLoan = $loan;
                                        break;
                                    }
                                }
                                // If no CONSOLIDATED DATA, pick the first one (default behavior)
                                if (!$selectedLoan) {
                                    $selectedLoan = $loans[0];
                                }
                            } else {
                                // Only one record, select it
                                $selectedLoan = $loans[0];
                            }

                            $indexId = $selectedLoan['loan_Id'];
                            $customer = $selectedLoan['customerFullName'];

                            if ($duecDLate <= 30) {
                                $letterStatus = 0;
                            } elseif ($duecDLate >= 31 && $duecDLate <= 60) {
                                $letterStatus = 1;
                            } elseif ($duecDLate >= 61 && $duecDLate <= 90) {
                                $letterStatus = 2;
                            } elseif ($duecDLate >= 91 && $duecDLate <= 105) {
                                $letterStatus = 3;
                            } else {
                                $letterStatus = 4;
                            }

                            // Update duecollection with the selected loan_Id
                            $updateThis = "UPDATE duecollection SET duecLoanId = '$indexId' WHERE duecBName = '$customer'";
                            $queryThis = mysqli_query($con, $updateThis);

                            if ($queryThis) {
                                // Update loan table fields
                                $updateStatusQuery = "UPDATE loan 
                                                                SET 
                                                                    productID = '$duecProdID', 
                                                                    letterStatus = '$letterStatus',
                                                                    loanStats = 1 
                                                                        WHERE loan_Id = '$indexId'";
                                $queryUpdateStatus = mysqli_query($con, $updateStatusQuery);
                            }
                        }
                    } else {
                        echo 'ERROR Insert: ' . mysqli_error($con);
                    }
                       
                    }
                }
            }
            echo "File uploaded and processed successfully.";
        } else {
            echo 'ERROR Insert'. mysqli_error($con);
        }
    }
}
?>

