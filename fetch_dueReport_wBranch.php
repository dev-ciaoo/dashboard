<?php
include('connection.php');

$output = array();
$selectBranch = $_POST['branch'];
$selectBranch = mysqli_real_escape_string($con, $selectBranch);

$sql = " SELECT SUM(duecTotalAmountDue) AS perfBal FROM duecollection as d 
              	LEFT JOIN loan as l ON l.loan_Id = d.duecLoanId 
				WHERE duecProdType <> 'SCR' 
						AND (
							(duecProdType NOT IN ('Microfinance Loan', 'Microfinance Plus', 'Salary Loan', 'Employee Loan') AND duecDLate >= 31) OR
							(duecProdType IN ('Microfinance Loan', 'Microfinance Plus') AND duecDLate >= 8) OR
							(duecProdType IN ('Salary Loan', 'Employee Loan') AND duecDLate >= 16)
							)
			  ";

if(!empty($selectBranch)){
	$sql .= " AND l.branch = '$selectBranch' ";
}

$query = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($query);

if($row && isset($row['perfBal'])){
	echo "<b>TOTAL AMOUNT DUE</b><span style='font-size: 12px;'><i> (Today)</i></span>: &nbsp;&nbsp;&nbsp;&nbsp; &#8369;" . number_format($row['perfBal'], 2, '.', ', ');
}else{
	echo "&#8369;" . number_format($row['perfBal'], 2, '.', ', ');
}
?>
