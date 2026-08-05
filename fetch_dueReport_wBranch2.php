<?php
include('connection.php');

$output = array();
$selectBranch = $_POST['branch'];
$selectBranch = mysqli_real_escape_string($con, $selectBranch);

$sql = " SELECT SUM(colTotalAmountDue) AS perfBalC FROM collectionarchive as c 
              	LEFT JOIN loan as l ON l.loan_Id = c.colLoanId 
				WHERE colProdType <> 'SCR'
					AND (
						(colProdType NOT IN ('Microfinance Loan', 'Microfinance Plus', 'Salary Loan', 'Employee Loan') AND colDueLate >= 31) OR
						(colProdType IN ('Microfinance Loan', 'Microfinance Plus') AND colDueLate >= 8) OR
						(colProdType IN ('Salary Loan', 'Employee Loan') AND colDueLate >= 16)
						)
                      ";
if(!empty($selectBranch)){
	$sql .= " AND l.branch = '$selectBranch' ";
}

$query = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($query);

if($row && isset($row['perfBalC'])){
	echo "<b>TOTAL AMOUNT DUE</b><span style='font-size: 12px;'><i> (Yesterday)</i></span>: &#8369;" . number_format($row['perfBalC'], 2, '.', ', ');
}else{
	echo "&#8369;" . number_format($row['perfBalC'], 2, '.', ', ');
}
?>
