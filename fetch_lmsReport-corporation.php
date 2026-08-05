
<?php
include('connection.php');

$output = array();
$branch = mysqli_real_escape_string($con, $_POST['branch']);
$sql = "SELECT l.*, m.* FROM loan AS l
                    INNER JOIN corporation as m ON l.loan_Id = m.corpLoanId 
					WHERE l.salaryType LIKE '%Corporation%'
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
						if($row['loanAppFormC'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['ccompanyProfile'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['governmentId'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['csecRegistration'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['clatestGIS'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['ccopyBRS'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['ccopyidCST'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['ctransferCertTitle'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['ctaxDeclaration'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['ctaxDeclartionICTC'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['crealStateReceipt'] == 'Check'){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['crealEstateTaxClearance'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['ccdOfMorgage'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['ccopyUpdatedBP'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['cauditedFinancial'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['cinhouseFinancial'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['clatestBank'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['incomeTaxReturn'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['contractLease'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['ccustomerContact'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['csupplierContact'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['cproofBilling'] != ''){
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
						if($row['creditInvestigationReportC'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['collateralAppraisalReportC'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['financialEvaluationC'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['signedLetterC'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['signedLoanMemoC'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['remContractC'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['remContractAnnotatedC'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['promNoteC'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['disclosureStateC'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['mriFormC'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['amortScheduleC'] != ''){
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
						if($row['powerAttorney'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['contractSell'] != ''){
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
						if($row['statementAccount'] != ''){
							echo "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
						}else{
							echo "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
						}
				echo 	'</td>';
				echo	'<td>';
						if($row['billMaterials'] != ''){
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
			if($row['loanAppFormC'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['ccompanyProfile'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['governmentId'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['csecRegistration'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['clatestGIS'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['ccopyBRS'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['ccopyidCST'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['ctransferCertTitle'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['ctaxDeclaration'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['ctaxDeclartionICTC'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['crealEstateTaxClearance'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['crealStateReceipt'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['ccdOfMorgage'] == ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['ccopyUpdatedBP'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['cauditedFinancial'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['cinhouseFinancial'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['clatestBank'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['incomeTaxReturn'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['contractLease'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['ccustomerContact'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['csupplierContact'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['cproofBilling'] != ''){
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
			if($row['creditInvestigationReportC'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['collateralAppraisalReportC'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; textm-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['financialEvaluationC'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['signedLetterC'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['signedLoanMemoC'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['remContractC'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['remContractAnnotatedC'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			//
			if($row['promNoteC'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['disclosureStateC'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['mriFormC'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; textm-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['amortScheduleC'] != ''){
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
			if($row['powerAttorney'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['contractSell'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['letterGuarantee'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['statementAccount'] != ''){
				$sub_array[] = "<img src='./statusImage/check.png' style='width: 15px; text-align: center;'>";
			}else{
				$sub_array[] = "<img src='./statusImage/xmark.png' style='width: 15px; text-align: center;'>";
			}
			if($row['billMaterials'] != ''){
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
