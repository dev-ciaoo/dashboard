
<?php
include('connection.php');

$output = array();
$branch = mysqli_real_escape_string($con, $_POST['branch']);
$sql = "SELECT l.*, m.* FROM loan AS l
                        INNER JOIN microfinance as m ON l.loan_Id = m.mLoan_Id
						WHERE l.salaryType LIKE '%Microfinance%'
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
						if ($row['loanAppFormM'] != '') {
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						} else {
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['mborrower_IdSign'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['mborrower_Lbp'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['mborrower_Lpb'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['coborrowerStatement'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['mcoBorrower_Id'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['proofIncome'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['comakerStatement'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['mcoMaker_IdSign'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['mcoMaker_Lbp'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['mcoMaker_Payslip'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['renewalCheck'] == 'Check'){
							echo "Yes";
						}else{
							echo "No";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['businessValidation'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['loanInstallment'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['loanPayment'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['statementAccount'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['validCardReport'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['creditReport'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['creditInvestigationReportM'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['debitWaiver'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['affidavitSurrender'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['loanApprovalSheet'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['riskRating'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['promissoryNoteM'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['disclosureStateM'] != ''){
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
						if($row['amortScheduleM'] != ''){
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
						if($row['businessPicture'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['otherSuport'] != ''){
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
			if ($row['loanAppFormM'] != '') {
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			} else {
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['mborrower_IdSign'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['mborrower_Lbp'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['mborrower_Lpb'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			
			if($row['coborrowerStatement'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['mcoBorrower_Id'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['proofIncome'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			
			if($row['comakerStatement'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['mcoMaker_IdSign'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['mcoMaker_Lbp'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['mcoMaker_Payslip'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}

			if($row['renewalCheck'] == 'Check'){
				$sub_array[] = 'Yes';
			}else{
				$sub_array[] = 'No';
			}
			if($row['businessValidation'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['loanInstallment'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['loanPayment'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['statementAccount'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}

			if($row['validCardReport'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['creditReport'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['creditInvestigationReportM'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['debitWaiver'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; textm-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['affidavitSurrender'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}

			if($row['loanApprovalSheet'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}

			if($row['riskRating'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			
			if($row['promissoryNoteM'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['disclosureStateM'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['mriForm'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['amortScheduleM'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['utilization'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}

			if($row['businessPicture'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['otherSuport'] != ''){
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
