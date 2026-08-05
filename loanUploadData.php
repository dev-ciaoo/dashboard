<?php

include('connection.php');
include('fileupload.php');

  date_default_timezone_set('Asia/Manila');
  $dateToday = date('M j, Y \a\t g:i A');
 
 
 $borrower_Id = $_FILES['borrower_Id'];
 $borrower_Idsignature = $_FILES['borrower_Idsignature'];
 $borrower_Lbp = $_FILES['borrower_Lbp'];
 $borrower_Lpb = $_FILES['borrower_Lpb'];


 $file1 =  upload_file($borrower_Id, 'microfinance');
 $file2 =  upload_file($borrower_Idsignature, 'microfinance');
 $file3 =  upload_file($borrower_Lbp, 'microfinance');
 $file4 =  upload_file($borrower_Lpb, 'microfinance');
 
 $borrower_Idd = $file1['path'];
 $borrower_Idsignatured = $file2['path'];
 $borrower_Lbpd = $file3['path'];
 $borrower_Lpbd = $file3['path'];



 $sql = "INSERT INTO microfinance (`borrower_Id`, `borrower_Idsignatures`, `borrower_Lbp`, `borrower_Lpb`, `date_Upload` ) 
 VALUES ('$borrower_Idd', '$borrower_Idsignatured', '$borrower_Lbpd', '$borrower_Lpbd' , '$dateToday')";

$query = mysqli_query($con, $sql);
$data = mysqli_insert_id($con);

if ($query==true) {

  echo '<script>alert("Success");</script>';
  
} else {

      echo("try something else");

}

?>
