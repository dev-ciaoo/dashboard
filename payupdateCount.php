<!-- <?php
// include('connection.php');

// $currentDate = date("Y-m-d");

// $sql = "SELECT * FROM pay_earnings WHERE datedeleted = ' ' AND slDuedate > $currentDate GROUP BY employeeId";

// $result = mysqli_query($con, $sql);

// if (mysqli_num_rows($result) > 0) {
//     while($row = mysqli_fetch_assoc($result)) {
//         $currentDate = new DateTime();
//         $loanDate = new DateTime($row['slDate']);
//         $payment = $row['slPayment'];
//         $slAmortization = $row['slAmortization'];
//         $salaryloan = $row['salaryloan'];
//         $slDuedate = $row['slDuedate'];


//         $yearsDiff = $currentDate->format('Y') - $loanDate->format('Y');
//         $monthsDiff = $currentDate->format('n') - $loanDate->format('n');

//         // Adjust for negative months difference (e.g., current date is in a previous year)
//         if ($monthsDiff < 0) {
//             $yearsDiff--;
//             $monthsDiff += 12;
//         }

//         // Calculate the total number of months passed
//         $monthsPassed = $yearsDiff * 12 + $monthsDiff;

//         $valmonthspassed = $monthsPassed *  $payment;

//         $slBalance = $salaryloan - ($slAmortization *  $valmonthspassed);

//         // Update the monthpassed column in the database
//         $updateSql = "UPDATE pay_earnings SET slCount = $monthsPassed, slBalance = $slBalance WHERE id = " . $row['id'];
//         mysqli_query($con, $updateSql);
//     }   
// } else {
//     //echo "No records found";
// }
// mysqli_close($con);
?> -->