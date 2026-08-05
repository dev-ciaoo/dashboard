    <?php
        include('connection.php');
        include('fileUploadBSP.php');

        print_r($_POST);
        date_default_timezone_set('Asia/Manila');
        $dateToday = date('M j, Y');
        
        $lendProcess = $_POST['lendProcess'];
        $lendCredit = $_POST['lendCredit'];
        $lendManagement = $_POST['lendManagement'];
        $lendSummary = $_POST['lendSummary'];
        $lendCopy = $_POST['lendCopy'];
        $lendSummary2 = $_POST['lendSummary2'];
        $lendSched	 = $_POST['lendSched'];
        $lendList	 = $_POST['lendList'];
        $lendLoan = $_POST['lendLoan'];
        $lendProcess2 = $_POST['lendProcess2'];
        $lendAging	 = $_POST['lendAging'];
        $lendSched2	 = $_POST['lendSched2'];
        $lendOther	 = $_POST['lendOther'];
        $lendLoan2	 = $_POST['lendLoan2'];
        $lendSummary3 = $_POST['lendSummary3'];
        $lendClass	 = $_POST['lendClass'];

        $lendProcessDesc = $_POST['lendProcessDesc'];
        $lendCreditDesc = $_POST['lendCreditDesc'];
        $lendManagementDesc = $_POST['lendManagementDesc'];
        $lendSummaryDesc = $_POST['lendSummaryDesc'];
        $lendCopyDesc = $_POST['lendCopyDesc'];
        $lendSummary2Desc = $_POST['lendSummary2Desc'];
        $lendSchedDesc = $_POST['lendSchedDesc'];
        $lendListDesc = $_POST['lendListDesc'];
        $lendLoanDesc = $_POST['lendLoanDesc'];
        $lendProcess2Desc = $_POST['lendProcess2Desc'];
        $lendAgingDesc = $_POST['lendAgingDesc'];
        $lendSched2Desc = $_POST['lendSched2Desc'];
        $lendOtherDesc = $_POST['lendOtherDesc'];
        $lendLoan2Desc = $_POST['lendLoan2Desc'];
        $lendSummary3Desc = $_POST['lendSummary3Desc'];
        $lendClassDesc = $_POST['lendClassDesc'];

        if(empty($lendProcessDesc) || $lendProcessDesc == ""){
            $lendProcessDesc = " ";
        }
        if(empty($lendCreditDesc) || $lendCreditDesc == ""){
            $lendCreditDesc = " ";
        }
        if(empty($lendManagementDesc) || $lendManagementDesc == ""){
            $lendManagementDesc = " ";
        }
        if(empty($lendSummaryDesc) || $lendSummaryDesc == ""){
            $lendSummaryDesc = " ";
        }
        if(empty($lendCopyDesc) || $lendCopyDesc == ""){
            $lendCopyDesc = " ";
        }
        if(empty($lendSummary2Desc) || $lendSummary2Desc == ""){
            $lendSummary2Desc = " ";
        }
        if(empty($lendSchedDesc) || $lendSchedDesc == ""){
            $lendSchedDesc = " ";
        }
        if(empty($lendListDesc) || $lendListDesc == ""){
            $lendListDesc = " ";
        }
        if(empty($lendLoanDesc) || $lendLoanDesc == ""){
            $lendLoanDesc = " ";
        }
        if(empty($lendProcess2Desc) || $lendProcess2Desc == ""){
            $lendProcess2Desc = " ";
        }
        if(empty($lendAgingDesc) || $lendAgingDesc == ""){
            $lendAgingDesc = " ";
        }
        if(empty($lendSched2Desc) || $lendSched2Desc == ""){
            $lendSched2Desc = " ";
        }
        if(empty($lendOtherDesc) || $lendOtherDesc == ""){
            $lendOtherDesc = " ";
        }
        if(empty($lendLoan2Desc) || $lendLoan2Desc == ""){
            $lendLoan2Desc = " ";
        }
        if(empty($lendSummary3Desc) || $lendSummary3Desc == ""){
            $lendSummary3Desc = " ";
        }
        if(empty($lendClassDesc) || $lendClassDesc == ""){
            $lendClassDesc = " ";
        }

        // GETTING THE FILES UPLOADED THEN PUTTING THEM IN A LOCALHOST FOLDER CALLED INDIVIDUAL
        // PRINCIPAL BORROWER// Get uploaded file paths
        $lendProcessFile = upload_file($_FILES['lendProcess'],'bsplending', $lendProcess);
        $lendCreditFile = upload_file($_FILES['lendCredit'],'bsplending', $lendCredit);
        $lendManagementFile = upload_file($_FILES['lendManagement'],'bsplending', $lendManagement);
        $lendSummaryFile = upload_file($_FILES['lendSummary'],'bsplending', $lendSummary);
        $lendCopyFile = upload_file($_FILES['lendCopy'],'bsplending', $lendCopy);
        $lendSummary2File = upload_file($_FILES['lendSummary2'],'bsplending', $lendSummary2);
        $lendSchedFile = upload_file($_FILES['lendSched'],'bsplending', $lendSched);
        $lendListFile = upload_file($_FILES['lendList'],'bsplending', $lendList);
        $lendLoanFile = upload_file($_FILES['lendLoan'],'bsplending', $lendLoan);
        $lendProcess2File = upload_file($_FILES['lendProcess2'],'bsplending', $lendProcess2);
        $lendAgingFile = upload_file($_FILES['lendAging'],'bsplending', $lendAging);
        $lendSched2File = upload_file($_FILES['lendSched2'],'bsplending', $lendSched2);
        $lendOtherFile = upload_file($_FILES['lendOther'],'bsplending', $lendOther);
        $lendLoan2File = upload_file($_FILES['lendLoan2'],'bsplending', $lendLoan2);
        $lendSummary3File = upload_file($_FILES['lendSummary3'],'bsplending', $lendSummary3);
        $lendClassFile = upload_file($_FILES['lendClass'],'bsplending', $lendClass);

        // PRINCIPAL BORROWER
        $lendProcessPath = $lendProcessFile['path'];
        $lendCreditPath = $lendCreditFile['path'];
        $lendManagementPath = $lendManagementFile['path'];
        $lendSummaryPath = $lendSummaryFile['path'];
        $lendCopyPath = $lendCopyFile['path'];
        $lendSummary2Path = $lendSummary2File['path'];
        $lendSchedPath = $lendSchedFile['path'];
        $lendListPath = $lendListFile['path'];
        $lendLoanPath = $lendLoanFile['path'];
        $lendProcess2Path = $lendProcess2File['path'];
        $lendAgingPath = $lendAgingFile['path'];
        $lendSched2Path = $lendSched2File['path'];
        $lendOtherPath = $lendOtherFile['path'];
        $lendLoan2Path = $lendLoan2File['path'];
        $lendSummary3Path = $lendSummary3File['path'];
        $lendClassPath = $lendClassFile['path'];



        // Check if data already exists in the database
        $sqlSelect = "SELECT * FROM `bsplending`";
        $selectQuery = mysqli_query($con, $sqlSelect);
        $data = mysqli_fetch_assoc($selectQuery);

        if ($data) {

        function addColumnUpdate(&$sqlUpdate, $columnName, $columnValue) {
            if (!empty($columnValue)) {
            $sqlUpdate .= " `$columnName` = '$columnValue',";
            }
        }

        $sqlUpdate = "UPDATE `bsplending` SET";
        // check each data path, If the data path is not empty, it will update

        // DATA
        addColumnUpdate($sqlUpdate, "lendProcess", $lendProcessPath );
        addColumnUpdate($sqlUpdate, "lendCredit", $lendCreditPath);
        addColumnUpdate($sqlUpdate, "lendManagement", $lendManagementPath);
        addColumnUpdate($sqlUpdate, "lendSummary", $lendSummaryPath);
        addColumnUpdate($sqlUpdate, "lendCopy", $lendCopyPath);
        addColumnUpdate($sqlUpdate, "lendSummary2", $lendSummary2Path);
        addColumnUpdate($sqlUpdate, "lendSched", $lendSchedPath);
        addColumnUpdate($sqlUpdate, "lendList", $lendListPath);
        addColumnUpdate($sqlUpdate, "lendLoan", $lendLoanPath);
        addColumnUpdate($sqlUpdate, "lendProcess2", $lendProcess2Path);
        addColumnUpdate($sqlUpdate, "lendAging", $lendAgingPath);
        addColumnUpdate($sqlUpdate, "lendSched2", $lendSched2Path);
        addColumnUpdate($sqlUpdate, "lendOther", $lendOtherPath);
        addColumnUpdate($sqlUpdate, "lendLoan2", $lendLoan2Path);
        addColumnUpdate($sqlUpdate, "lendSummary3", $lendSummary3Path);
        addColumnUpdate($sqlUpdate, "lendClass", $lendClassPath);


        // STATUS FUNCTION
        function addStatus(&$sqlUpdate, $columnStatus, $columnSelect, $description) {
            if (!empty($columnSelect)) {
            $sqlUpdate .= " `$columnStatus` = '$columnSelect',";
            }
        }

        // PRINCIPAL BORROWER
        addStatus($sqlUpdate, "lendProcessDesc", $lendProcessDesc, "");
        addStatus($sqlUpdate, "lendCreditDesc", $lendCreditDesc, "");
        addStatus($sqlUpdate, "lendManagementDesc", $lendManagementDesc, "");
        addStatus($sqlUpdate, "lendSummaryDesc", $lendSummaryDesc, "");
        addStatus($sqlUpdate, "lendCopyDesc", $lendCopyDesc, "");
        addStatus($sqlUpdate, "lendSummary2Desc", $lendSummary2Desc, "");
        addStatus($sqlUpdate, "lendSchedDesc", $lendSchedDesc, "");
        addStatus($sqlUpdate, "lendListDesc", $lendListDesc, "");
        addStatus($sqlUpdate, "lendLoanDesc", $lendLoanDesc, "");
        addStatus($sqlUpdate, "lendProcess2Desc", $lendProcess2Desc, "");
        addStatus($sqlUpdate, "lendAgingDesc", $lendAgingDesc, "");
        addStatus($sqlUpdate, "lendSched2Desc", $lendSched2Desc, "");
        addStatus($sqlUpdate, "lendOtherDesc", $lendOtherDesc, "");
        addStatus($sqlUpdate, "lendLoan2Desc", $lendLoan2Desc, "");
        addStatus($sqlUpdate, "lendSummary3Desc", $lendSummary3Desc, "");
        addStatus($sqlUpdate, "lendClassDesc", $lendClassDesc, "");

        $sqlUpdate = rtrim($sqlUpdate, ', ');

        $sqlUpdate .= "WHERE id = 1";

        $updateQuery = mysqli_query($con, $sqlUpdate);


        if ($updateQuery == true) {
            // Update successful
        } else {
            echo "Error: " . mysqli_error($con);
        }
        } else {
        // Insert new record
        $insertSql = "INSERT INTO `bsplending` (`lendProcess`, `lendCredit`, `lendManagement`, `lendSummary`, `lendCopy`,`lendSummary2`, `lendSched`, `lendList`,
                                                `lendLoan`, `lendProcess2`, `lendAging`, `lendSched2`, `lendOther`, `lendLoan2`, `lendSummary3`, `lendClass`) 
                                    VALUES 
                                                ('$lendProcessPath', '$lendCreditPath', '$lendManagementPath', '$lendSummaryPath', '$lendCopyPath', '$lendSummary2Path', '$lendSchedPath', '$lendListPath', 
                                                '$lendLoanPath', '$lendProcess2Path', '$lendAgingPath', '$lendSched2Path', '$lendOtherPath', '$lendLoan2Path', '$lendSummary3Path', '$lendClassPath')";
        $insertQuery = mysqli_query($con, $insertSql);

        if ($insertQuery) {
            echo "Insert successful";
        } else {
            echo "Error: " . mysqli_error($con);
        }
        }   
        ?>  