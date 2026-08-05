
<?php
include('connection.php');

$output = array();
$branch = mysqli_real_escape_string($con, $_POST['branch']);
$sql = "SELECT l.*, m.* FROM loan AS l
                        INNER JOIN individual as m ON l.loan_Id = m.indivLoanId
						WHERE l.salaryType LIKE '%Individual%'
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
						if ($row['endorsement'] != '') {
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						} else {
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['loanAppFormI'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['photocopyIdSignatures'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['proofBilling'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['personalBank'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['marriageContract'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['barangayClearance'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['transferCertificate'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['taxDeclarationLot'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['taxDeclarationImp'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['realEstateTaxClearance'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['realEstateTaxReceipt'] == 'Check'){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['cancellationDischarge'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['employmentContract'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['certificateEmployment'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['incomeTax'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['payslipMonths'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['otherIncome'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['receipt'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['creditInvestigationReportI'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['collateralAppraisalReportI'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['financialEvaluationI'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['signedLetterI'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['signedLoanMemoI'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['remContractI'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['remContractAnnotatedI'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['promNoteI'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['disclosureStateI'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['mriFormI'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['amortScheduleI'] != ''){
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
						if($row['powerpoint'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['excel'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['powerAttorneyI'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['generalInfo'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['securityExchange'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['letterGuarantee'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['boardResolution'] != ''){
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
						if($row['billMaterial'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['proposedPlan'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['otherDoc'] != ''){
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
			if ($row['endorsement'] != '') {
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			} else {
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['loanAppFormI'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['photocopyIdSignatures'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['proofBilling'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['personalBank'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['marriageContract'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['barangayClearance'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['transferCertificate'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['taxDeclarationLot'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['taxDeclarationImp'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['realEstateTaxClearance'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['realEstateTaxReceipt'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['cancellationDischarge'] == ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['employmentContract'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['certificateEmployment'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['incomeTax'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['payslipMonths'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['otherIncome'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['receipt'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['creditInvestigationReportI'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['collateralAppraisalReportI'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; textm-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['financialEvaluationI'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['signedLetterI'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['signedLoanMemoI'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['remContractI'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['remContractAnnotatedI'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['promNoteI'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['disclosureStateI'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['mriFormI'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; textm-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['amortScheduleI'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['utilization'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['powerpoint'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['excel'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['powerAttorneyI'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['generalInfo'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['securityExchange'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['letterGuarantee'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['boardResolution'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['statementAccount'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['billMaterial'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['proposedPlan'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['otherDoc'] != ''){
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
