
<?php
include('connection.php');

$output = array();
$branch = mysqli_real_escape_string($con, $_POST['branch']);
$sql = "SELECT d.*, l.*, c.*, m.*
								FROM loan AS l
								RIGHT JOIN duecollection AS d ON l.loan_Id = d.duecLoanId
								LEFT JOIN consolidated AS c ON c.consLoanId = l.loan_Id
								LEFT JOIN salaryloan AS m ON m.salaryLoanId = l.loan_Id
								WHERE l.salaryType IN ('Salary Loan', 'Employee Loan', 'Salary', 'salary', 'Consumer Loan - Employee')
		";

if(!empty($branch)) {
	$sql .= " AND l.branch = '$branch'";
}

// $columns = array(
//     0 => 'productID',
//     1 => 'customerFullName',
//     2 => 'branch',
//     3 => 'salaryType',
//     4 => 'amountApplied',
//     5 => 'terms',
//     6 => 'interestRate'
// );

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " AND (l.customerFullName LIKE '%" . mysqli_real_escape_string($con, $search_value) . "%'";
    $sql .= " OR l.branch LIKE '%" . mysqli_real_escape_string($con, $search_value) . "%')";
}

if (isset($_POST['order'])) {
    $column_index = intval($_POST['order'][0]['column']);
    $order = $_POST['order'][0]['dir'] === 'asc' ? 'ASC' : 'DESC';

	$columns = [
		0 => 'customerFullName',
		1 => 'branch',
		3 => 'duecDLate'
	];

	if(isset($columns[$column_index])){
		$column_name = $columns[$column_index];

		if($column_name === 'duecDLate'){
			$sql .= " ORDER BY d.$column_name $order";
		}else{
			$sql .= " ORDER BY l.$column_name $order";
		}
	}
}else{
	$sql .= " ORDER BY d.duecDLate ASC ";
}


if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $limit_condition_sql = $sql;
    $limit_condition_sql .= " LIMIT " . intval($start) . ", " . intval($length); // Added intval for security
}

$query = mysqli_query($con, isset($limit_condition_sql) ? $limit_condition_sql : $sql);
$count_query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($count_query);
$data = array();

if (!empty($branch)) {
    
    // Fetch the count of rows
    $count_rows = mysqli_num_rows($count_query);

    $tbody= '';
    if ($count_rows > 0) {
        while ($row = mysqli_fetch_assoc($count_query)) {
			if ($row['loanType'] == 'CONSOLIDATED DATA') {
				echo '<tr>';
					echo    '<td>' . $row['customerFullName'] . '</td>';
					echo    '<td>' . $row['branch'] . '</td>';
					echo    '<td>' . $row['salaryType'] . '</td>';
					echo    '<td>' . $row['duecDLate'] . '</td>';
					echo    '<td>' . $row['phoneRemarks'] . '</td>';
					echo	'<td>';
							if ($row['consfLetter'] != '') {
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							} else {
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['consfLetter2'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['consfLetter3'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['consfLetterRemarks'] . '</td>';
					echo	'<td>';
							if($row['conssLetter'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['conssLetter2'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['conssLetter3'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['conssLetterRemarks'] . '</td>';
					echo	'<td>';
							if($row['constLetter'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['constLetter2'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['constLetter3'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['constLetterRemarks'] . '</td>';
					echo	'<td>';
							if($row['consfdLetter'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['consfdLetter2'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['consfdLetter3'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['consfdLetterRemarks'] . '</td>';
					echo	'<td>';
							if($row['consffClosure'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['consffClosureRemarks'] . '</td>';
					echo	'<td>';
							if($row['conspastLitigation'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['conspastLitigationRemarks'] . '</td>';
					echo	'<td>';
							if($row['consttLitigation'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['consttLitigationRemarks'] . '</td>';
					echo	'<td>';
							if($row['consPrepConso'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['consPrepConsoRemarks'] . '</td>';
					echo	'<td>';
							if($row['consaDemand'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $sub_array[] = $row['consaDemandRemarks'] . '</td>';
					
				echo '</tr>';
			}else{
				echo '<tr>';
					echo    '<td>' . $row['customerFullName'] . '</td>';
					echo    '<td>' . $row['branch'] . '</td>';
					echo    '<td>' . $row['salaryType'] . '</td>';
					echo    '<td>' . $row['duecDLate'] . '</td>';
					echo    '<td>' . $row['phoneRemarks'] . '</td>';
					echo	'<td>';
							if ($row['sfLetter'] != '') {
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							} else {
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['sfLetter2'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['sfLetter3'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['sfLetterRemarks'] . '</td>';
					echo	'<td>';
							if($row['ssLetter'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['ssLetter2'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['ssLetter3'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['ssLetterRemarks'] . '</td>';
					echo	'<td>';
							if($row['stLetter'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['stLetter2'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['stLetter3'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['stLetterRemarks'] . '</td>';
					echo	'<td>';
							if($row['sfdLetter'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['sfdLetter2'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo	'<td>';
							if($row['sfdLetter3'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['sfdLetterRemarks'] . '</td>';
					echo	'<td>';
							if($row['sffClosure'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['sffClosureRemarks'] . '</td>';
					echo	'<td>';
							if($row['spastLitigation'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['spastLitigationRemarks'] . '</td>';
					echo	'<td>';
							if($row['sttLitigation'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['sttLitigationRemarks'] . '</td>';
					echo	'<td>';
							if($row['sPrepConso'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $row['sPrepConsoRemarks'] . '</td>';
					echo	'<td>';
							if($row['saDemand'] != ''){
								echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
							}else{
								echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
							}
					echo 	'</td>';
					echo 	'<td>' . $sub_array[] = $row['saDemandRemarks'] . '</td>';
				echo '</tr>';
			}
        }  
    }
}else{
	while ($row = mysqli_fetch_assoc($query)) {
		$sub_array = array();

		if ($row['loanType'] == 'CONSOLIDATED DATA') {
			$sub_array[] = $row['customerFullName'];
			$sub_array[] = $row['branch'];
			$sub_array[] = $row['salaryType'];
			$sub_array[] = $row['duecDLate'];
			$sub_array[] = $row['phoneRemarks'];
			if ($row['consfLetter'] != '') {
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			} else {
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['consfLetter2'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['consfLetter3'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['consfLetterRemarks']; //1st Remarks
			if($row['conssLetter'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['conssLetter2'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['conssLetter3'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['conssLetterRemarks']; //2nd Remarks
			if($row['constLetter'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['constLetter2'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['constLetter3'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['constLetterRemarks']; //3rd Remarks
			if($row['consfdLetter'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['consfdLetter2'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['consfdLetter3'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['consfdLetterRemarks']; //final Remarks
			if($row['consffClosure'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['consffClosureRemarks']; //ForeClosure Remarks
			if($row['conspastLitigation'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['conspastLitigationRemarks']; //Past Litigation Remarks
			if($row['consttLitigation'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['consttLitigationRemarks']; //Transfer Litigation Remarks
			if($row['consPrepConso'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['consPrepConsoRemarks']; //Prep Conso Remarks
			if($row['consaDemand'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['consaDemandRemarks']; //Prep Conso Remarks
		} else{
			$sub_array[] = $row['customerFullName'];
			$sub_array[] = $row['branch'];
			$sub_array[] = $row['salaryType'];
			$sub_array[] = $row['duecDLate'];
			$sub_array[] = $row['phoneRemarks'];
			if ($row['sfLetter'] != '') {
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			} else {
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['sfLetter2'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['sfLetter3'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['sfLetterRemarks']; //1st Remarks
			if($row['ssLetter'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['ssLetter2'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['ssLetter3'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['ssLetterRemarks']; //2nd Remarks
			if($row['stLetter'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['stLetter2'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['stLetter3'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['stLetterRemarks']; //3rd Remarks
			if($row['sfdLetter'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['sfdLetter2'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['sfdLetter3'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['sfdLetterRemarks']; //final Remarks
			if($row['sffClosure'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; textm-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['sffClosureRemarks']; //ForeClosure Remarks
			if($row['spastLitigation'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['spastLitigationRemarks']; //Past Litigation Remarks
			if($row['sttLitigation'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['sttLitigationRemarks']; //Transfer Litigation Remarks
			if($row['sPrepConso'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['msPrepConsoRemarks']; //Prep Conso Remarks
			if($row['saDemand'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			$sub_array[] = $row['saDemandRemarks']; //Demand Remarks
		}
		
		$data[] = $sub_array;
	}
	$output = array(
		'draw' => intval($_POST['draw']),
		'recordsTotal' => $count_rows,
		'recordsFiltered' => $count_rows,
		'data' => $data,
	);
	echo json_encode($output);
}

?>
