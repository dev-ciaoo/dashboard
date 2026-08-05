<?php
    include('connection.php');

    $id = $_GET['id'];

    $id = mysqli_real_escape_string($con, $id);

    $sql="SELECT * FROM pay_otherpayment WHERE employeeId = $id AND datedeleted = ''";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
        
        $idPay = $row['id'];
        $datePay = $row['date'];
        $amountPay = $row['amount'];
        $remarksPay = $row['remarks'];

        }
    } else {
      
    }

?>


