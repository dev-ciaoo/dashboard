    <?php
        include('connection.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $postData = json_encode($_POST);
            
            echo "<script>console.log('POST data:', $postData);</script>";
        
           
            $id = $_POST['id'];
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

            $sssloan = $_POST['sssloan'];
            $sssloanDate = $_POST['sssloanDate'];
            $sssloanDuedate = $_POST['sssloanDuedate'];

            $ssscalamity = $_POST['ssscalamity'];
            $ssscalamityDate = $_POST['ssscalamityDate'];
            $ssscalamityDuedate = $_POST['ssscalamityDuedate'];

            $pagibigloan = $_POST['pagibigloan'];
            $pagibigloanDate = $_POST['pagibigloanDate'];
            $pagibigloanDuedate = $_POST['pagibigloanDuedate'];

            $pagibigcalamity = $_POST['pagibigcalamity'];
            $pagibigcalamityDate = $_POST['pagibigcalamityDate'];
            $pagibigcalamityDuedate = $_POST['pagibigcalamityDuedate'];

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
                `sssloan`,`sssloandate`,`sssloanDuedate`,`ssscalamity`, `ssscalamityDate`,`ssscalamityDuedate`,`pagibigloan`,`pagibigloanDate`,`pagibigloanDuedate`,`pagibigcalamity`,`pagibigcalamityDate`,`pagibigcalamityDuedate`) 
                VALUES (?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

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
                mysqli_stmt_bind_param($stmt, "isssssssssssssssssssssssssssssssss", $id, $name, $monthlyrate, $branch, $riceallowance, $transpo, $currentDate, $pagibig,$sss, $sssmand,
                 $tax,$philhealth,$salaryloan,$slyear,$slPayment,$slDate,$slDuedate,$slAmortization,$slBalance,$slCount,$slcutoffSelect,$slBank,
                 $sssloan,$sssloanDate, $sssloanDuedate,$ssscalamity,$ssscalamityDate,$ssscalamityDuedate,$pagibigloan,$pagibigloanDate,$pagibigloanDuedate,$pagibigcalamity,$pagibigcalamityDate,$pagibigcalamityDuedate);
                mysqli_stmt_execute($stmt);

                // Check if the operation was successful
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    // Redirect to the page after successful update or insert
                    header("Location: payearnings.php");
                    exit();
                } else {
                    echo "Error updating/inserting record: " . mysqli_error($con);
                }
        
                // Close the database connection
                mysqli_stmt_close($stmt);
                mysqli_close($con);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    ?>
