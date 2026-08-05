    <?php
        include('connection.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $postData = json_encode($_POST);
            
           
            $id = $_POST['employeeId'];
            $name = $_POST['name'];
            $position = $_POST['bankPosition'];
            $branch = $_POST['address'];
            $monthlyrate = $_POST['monthlyrate'];
            $riceallowance = $_POST['riceallowance'];
            $transpo = $_POST['transpo'];
            $pagibig = $_POST['pagibig'];
            $sss = $_POST['sss'];
            $sssmand = $_POST['sssmand'];
            $tax = $_POST['tax'];
            $philhealth = $_POST['philhealth'];
            $specialAllow = $_POST['specialAllow'];

            $sssloan = $_POST['sssloan'];
            $sssloanDate = $_POST['sssloanDate'];
            $sssloanDuedate = $_POST['sssloanDuedate'];
            $sssloanPayment = $_POST['sssloanPayment'];
            $sssloanCutoffSelect = $_POST['sssloanCutoffSelect'];

            $ssscalamity = $_POST['ssscalamity'];
            $ssscalamityDate = $_POST['ssscalamityDate'];
            $ssscalamityDuedate = $_POST['ssscalamityDuedate'];
            $ssscalamityPayment = $_POST['ssscalamityPayment'];
            $ssscalamityCutoffSelect = $_POST['ssscalamityCutoffSelect'];

            $pagibigloan = $_POST['pagibigloan'];
            $pagibigloanDate = $_POST['pagibigloanDate'];
            $pagibigloanDuedate = $_POST['pagibigloanDuedate'];
            $pagibigloanPayment = $_POST['pagibigloanPayment'];
            $pagibigloanCutoffSelect = $_POST['pagibigloanCutoffSelect'];

            $pagibigcalamity = $_POST['pagibigcalamity'];
            $pagibigcalamityDate = $_POST['pagibigcalamityDate'];
            $pagibigcalamityDuedate = $_POST['pagibigcalamityDuedate'];
            $pagibigcalamityPayment = $_POST['pagibigcalamityPayment'];
            $pagibigcalamityCutoffSelect = $_POST['pagibigcalamityCutoffSelect'];

            $salaryloan = $_POST['salaryloan'];
            $slBalance = $_POST['slBalance'];
            $slyear = $_POST['slyear'];
            $slPayment = $_POST['slPayment'];
            $slDate = $_POST['slDate'];
            $slDuedate = $_POST['slDuedate'];
            $slAmortization = $_POST['slAmortization'];
            $slCount = $_POST['slCount'];
            $slcutoffSelect = $_POST['slcutoffSelect'];
            $slBank = $_POST['slBank'];
            $currentDate = date("Y-m-d");

            if($transpo == ""){
                $transpo =  0.00;
            }

            try {
                // Prepare the INSERT query
                $query = "INSERT INTO pay_earnings (`employeeId`, `name`, `MonthlySalary`, `branch`, `RiceAllowance`, `TranspoAllowance`, `datemodified`,`pagibig`,`sss`,`sssmandprovident`,`withholdingtax`,
                `philhealth`,`salaryloan`,`slYear`,`slPayment`,`slDate`,`slDuedate`,`slAmortization`,`slBalance`,`slCount`,`slCutoffSelect`,`slBank`,
                `sssloan`,`sssloandate`,`sssloanDuedate`,`sssloanPayment`,`sssloanCutoffSelect`,`ssscalamity`, `ssscalamityDate`,`ssscalamityDuedate`,`ssscalamityPayment`,`ssscalamityCutoffSelect`,`pagibigloan`,`pagibigloanDate`,`pagibigloanDuedate`,`pagibigloanPayment`,`pagibigloanCutoffSelect`,
                `pagibigcalamity`,`pagibigcalamityDate`,`pagibigcalamityDuedate`,`pagibigcalamityPayment`,`pagibigcalamityCutoffSelect`,`specialAllow`) 
                VALUES (?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                // Check if the employee ID exists in the pay_earnings table
                $check_query = "SELECT employeeId FROM pay_earnings WHERE employeeId = ?";
                $stmt_check = mysqli_prepare($con, $check_query);
                mysqli_stmt_bind_param($stmt_check, "i", $id);
                mysqli_stmt_execute($stmt_check);
                mysqli_stmt_store_result($stmt_check);
                $num_rows = mysqli_stmt_num_rows($stmt_check);

                if ($num_rows > 0) {
                    // If the employee ID exists, perform an update
                    $update_query ="UPDATE pay_earnings SET
                                    `datedeleted` = ?
                                    WHERE employeeId = ?";
                    $stmt_update = mysqli_prepare($con, $update_query);
                    mysqli_stmt_bind_param($stmt_update, "si", $currentDate, $id);
                    mysqli_stmt_execute($stmt_update);
                    mysqli_stmt_close($stmt_update);
                }

                // Execute the insert query
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "issssssssssssssssssssssssssssssssssssssssss", $id, $name, $monthlyrate, $branch, $riceallowance, $transpo, $currentDate, $pagibig,$sss, $sssmand,
                 $tax,$philhealth,$salaryloan,$slyear,$slPayment,$slDate,$slDuedate,$slAmortization,$slBalance,$slCount,$slcutoffSelect,$slBank,
                 $sssloan,$sssloanDate, $sssloanDuedate,$sssloanPayment,$sssloanCutoffSelect,$ssscalamity,$ssscalamityDate,$ssscalamityDuedate,$ssscalamityPayment,$ssscalamityCutoffSelect,$pagibigloan,$pagibigloanDate,$pagibigloanDuedate,$pagibigloanPayment,$pagibigloanCutoffSelect,
                 $pagibigcalamity,$pagibigcalamityDate,$pagibigcalamityDuedate,$pagibigcalamityPayment,$pagibigcalamityCutoffSelect,$specialAllow);
                mysqli_stmt_execute($stmt);

                // Check if the operation was successful
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    header("Location: pay-employeemanagement.php");
                } else {
                    echo "Error updating/inserting record: " . mysqli_error($con);
                    header("Location: pay-employeemanagement.php");
                }
        
                // Close the database connection
                mysqli_stmt_close($stmt);
                mysqli_close($con);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    ?>
