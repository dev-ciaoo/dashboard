
<?php
include('connection.php');

$output = array();
$branch = mysqli_real_escape_string($con, $_POST['branch']);
$sql = "SELECT l.*, m.* FROM loan AS l
                        INNER JOIN salaryloan as m ON l.loan_Id = m.salaryLoanId
						WHERE l.salaryType LIKE '%Salary%'
							AND l.pipeStats <> 2
		";

if(!empty($branch)) {
	$sql .= " AND l.branch = '$branch'";
}

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
		2 => 'salaryType',
		3 => 'dateCreated'
	];

	if(isset($columns[$column_index])){
		$column_name = $columns[$column_index];

		$sql .= " ORDER BY l.$column_name $order";
	}
}else{
	$sql .= " ORDER BY l.customerFullName ASC ";
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
            echo '<tr>';
				echo    '<td>' . $row['customerFullName'] . '</td>';
				echo    '<td>' . $row['branch'] . '</td>';
				echo    '<td>' . $row['salaryType'] . '</td>';
				echo    '<td>' . $row['dateCreated'] . '</td>';
				echo	'<td>';
						if ($row['loanAppForm'] != '') {
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						} else {
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['memoAgreementS'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['certofEmployment'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['latestPayslip'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['tin'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['clearanceLoan'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['coMaker1'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['validSignatures'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['monthsPayslip'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['coMaker2'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['validSignatures2'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['monthsPayslip2'] == ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['deductRemit'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['cashflowScore'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['loanAppMemo'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['promissoryNoteS'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['disclosureStateS'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['mriForm'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['amortScheduleS'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['utilization'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['kapasyahan'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['brgyReso'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['canvassVote'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['oathTaking'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';

            echo '</tr>';
        }  
    }
}else{
	while ($row = mysqli_fetch_assoc($query)) {
		$sub_array = array();
		
			$sub_array[] = strtoupper($row['customerFullName']);
			$sub_array[] = $row['branch'];
			$sub_array[] = $row['salaryType'];
			$sub_array[] = $row['dateCreated'];
			if ($row['loanAppForm'] != '') {
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			} else {
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['memoAgreementS'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['certofEmployment'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['latestPayslip'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['tin'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['clearanceLoan'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}

			if($row['coMaker1'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['validSignatures'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['monthsPayslip'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}

			if($row['coMaker2'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['validSignatures2'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['monthsPayslip2'] == 'Check'){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}

			if($row['deductRemit'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['cashflowScore'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['loanAppMemo'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}

			if($row['promissoryNoteS'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['disclosureStateS'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['mriForm'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['amortScheduleS'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}

			if($row['utilization'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; textm-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}

			if($row['kapasyahan'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['brgyReso'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['canvassVote'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['oathTaking'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}

			$sub_array[] = "<button style='display: inline;' class='btn btn-primary btn-sm btnCheckC'  id='" . $row['loan_Id'] . "' name='results' value='" . $row['salaryType'] . "' type='button'>OPEN</button>";
		
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
