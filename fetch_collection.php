<?php
include('connection.php');

$output = array();
$sql = " SELECT l.*, d.* FROM duecollection as d 
            	JOIN loan as l ON l.loan_Id = d.duecLoanId";

// $columns = array(
// 	0 => 'id',
// 	1 => 'duecBranch',
// 	2 => 'duecProdID',
// 	3 => 'duecBName',
//     4 => 'duecContact',
// 	5 => 'duecStatus',
// 	6 => 'duecProdType',
// 	7 => 'duecLoanG',
// 	8 => 'duecLoanM',
// 	9 => 'duecDueDate',
// 	10 => 'duecDLate',
// 	11 => 'duecPrincipalAmount',
// 	12 => 'duecPrincipalBal',
// 	13 => 'duecPrincipalDue',
// 	14 => 'duecInterest',
// 	15 => 'duecPenalty',
// 	16 => 'duecTotalAmountDue',
// 	17 => 'duecLastUnpaid',
// 	18 => 'dStatus',
// 	19 => 'remarks2',
// 	20 => 'phoneRemarks',
// 	21 => 'dateImported'
// );

if (isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE (d.duecBranch LIKE '%" . $search_value . "%'";
	$sql .= " OR d.duecProdID LIKE '%" . $search_value . "%'";
	$sql .= " OR d.duecBName LIKE '%" . $search_value . "%'";
	$sql .= " OR d.duecStatus LIKE '%" . $search_value . "%'";
	$sql .= " OR d.duecProdType LIKE '%" . $search_value . "%')";
	
	if($_SESSION['position'] === 'BM' && $_SESSION['address'] !== 'Head Office') {
		$sql .= " AND (d.duecBranch = '" . $_SESSION['address'] . "')";
	}
	else if($_SESSION['bankposition'] === 'LOAN Assistant' && $_SESSION['address'] !== 'Head Office'){
		$sql .= " AND (d.duecBranch = '" . $_SESSION['address'] . "')";
	}else if($_SESSION['bankposition'] === 'Marketing Staff' && $_SESSION['address'] !== 'Head Office'){
		$sql .= " AND (d.duecBranch = '" . $_SESSION['address'] . "')";
	}
	else{
		if($_SESSION['position'] === 'BM' && $_SESSION['address'] === 'Head Office'){
			$sql .= " AND (d.duecBranch = 'Head Office')";
		}
		else if($_SESSION['bankposition'] == 'Branch Cashier' && $_SESSION['address'] == 'Head Office'){
			$sql .= " AND (d.duecBranch = 'Head Office')";
		}
	}
}else {
	if($_SESSION['position'] === 'BM' && $_SESSION['address'] !=='Head Office') {
		$sql .= " AND (d.duecBranch = '" . $_SESSION['address'] . "')";
	}
	else if($_SESSION['bankposition'] === 'LOAN Assistant' && $_SESSION['address'] !== 'Head Office'){
		$sql .= " AND (d.duecBranch = '" . $_SESSION['address'] . "')";
	}else if($_SESSION['bankposition'] === 'Marketing Staff' && $_SESSION['address'] !== 'Head Office'){
		$sql .= " AND (d.duecBranch = '" . $_SESSION['address'] . "')";
	}
	else{
		if($_SESSION['position'] === 'BM' && $_SESSION['address'] === 'Head Office'){
			$sql .= " AND (d.duecBranch = 'Head Office')";
		}
		else if($_SESSION['bankposition'] === 'LOAN Assistant' && $_SESSION['address'] === 'Head Office'){
			$sql .= " AND (d.duecBranch = 'Head Office')";
		}
	}
}

if (isset($_POST['order'])) {
    $column_index = intval($_POST['order'][0]['column']);
    $order = $_POST['order'][0]['dir'] === 'asc' ? 'ASC' : 'DESC';

	$columns = [
		0 => 'duecBranch',
		1 => 'duecProdType',
		3 => 'duecDLate',
		5 => 'duecStatus',
		7 => 'duecDLate'
	];

	if(isset($columns[$column_index])){
		$column_name = $columns[$column_index];

		$sql .= " ORDER BY d.$column_name $order";
	}
}else{
	$sql .= " ORDER BY d.duecDLate ASC ";
}

if ($_POST['length'] != -1) {
	$start = $_POST['start'];
	$length = $_POST['length'];
	$limit_condition_sql = $sql;
	$limit_condition_sql .= " LIMIT  " . $start . ", " . $length . "";
}

$query = mysqli_query($con, $limit_condition_sql);
$count_query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($count_query);
$data = array();
while ($row = mysqli_fetch_assoc($query)) {
	$sub_array = array();
	$sub_array[] = $row['duecBranch'];
	$sub_array[] = $row['duecProdType'];
	$sub_array[] = $row['duecProdID'];
	$sub_array[] = $row['duecBName'];
	$sub_array[] = $row['duecContact'];
	if($row['duecStatus'] == 'a'){
		$sub_array[] = "";
	}else{
		$sub_array[] = $row['duecStatus'];
	}
	$sub_array[] = $row['duecDueDate'];
	$sub_array[] = $row['duecDLate'];
	$sub_array[] = number_format($row['duecPrincipalBal'], 2, '.', ',');
	$sub_array[] = number_format($row['duecPrincipalDue'], 2, '.', ',');
	$sub_array[] = number_format($row['duecInterest'], 2, '.', ',');
	$sub_array[] = number_format($row['duecPenalty'], 2, '.', ',');
	$sub_array[] = number_format($row['duecTotalAmountDue'], 2, '.', ',');
	$sub_array[] = $row['duecLastUnpaid'];
	// $sub_array[] = $row['remarks'];
	// $sub_array[] = $row['letterStatus'];
	if($row['letterStatus'] == 0) {
		if($row['duecDLate'] >= 1 && $row['duecDLate'] <= 30){
			if($row['remarks'] != ""){
				$sub_array[] = $row['remarks'];
			}else{
				$sub_array[] = 'FOLLOW UP PAYMENT';
			}
		}else{
			if($row['duecDLate'] != 0 && $row['remarks'] != ""){
				$sub_array[] = $row['remarks'];
			}else{
				$sub_array[] = 'FOR REMINDER';
			}
		}	
	}else if($row['letterStatus'] == 1 && $row['duecDLate'] >= 31 && $row['duecDLate'] <= 60) {
			$sub_array[] = $row['remarks'];
	}else if($row['letterStatus'] == 2) {
		if($row['duecDLate'] >= 61 && $row['duecDLate'] <= 90){
			$sub_array[] = $row['remarks'];
		}else{
			$sub_array[] = '2nd Demand Letter';
		}
	}else if($row['letterStatus'] == 3) {
		if($row['duecDLate'] >= 91 && $row['duecDLate'] <= 105){
			$sub_array[] = $row['remarks'];
		}else{
			$sub_array[] = '3rd Demand Letter';
		}
	}else if($row['letterStatus'] == 4) {
		if($row['duecDLate'] >= 106){
			$sub_array[] = $row['remarks'];
		}else{
			$sub_array[] = 'Final Demand Letter';
		}
	}else if($row['letterStatus'] == 5) {
		$sub_array[] = 'RECOMMENDED FOR FORECLOSURE';
	}else if($row['letterStatus'] == 6) {
		$sub_array[] = 'PASTDUE TO LITIGATION';
	}else if($row['letterStatus'] == 7) {
		$sub_array[] = 'TRANSFER FROM LITIGATION TO ROPA';
	}else if($row['letterStatus'] == 8) {
		$sub_array[] = 'ANNOTATION OF COS';
	}else if($row['letterStatus'] == 9) {
		$sub_array[] = 'PREPARE TO CONSOLIDATION IN THE NAME OF THE BANK';
	}else{
		$sub_array[] = $row['remarks'];
	}

	$sub_array[] = '<div class="scrollable-td">' . $row['phoneRemarks'] . '</div>';

	if($row['letterStatus'] == 0){
		$sub_array[] = 'INCOMING DUE';
	}else if($row['letterStatus'] == 1) {
		$sub_array[] = '1st Demand Letter';
	}else if($row['letterStatus'] == 2) {
		$sub_array[] = '2nd Demand Letter';
	}else if($row['letterStatus'] == 3) {
		$sub_array[] = '3rd Demand Letter';
	}else if($row['letterStatus'] == 4) {
		$sub_array[] = 'Final Demand Letter';
	}else if($row['letterStatus'] == 5) {
		$sub_array[] = 'RECOMMENDED FOR FORECLOSURE';
	}else if($row['letterStatus'] == 6) {
		$sub_array[] = 'PASTDUE TO LITIGATION';
	}else if($row['letterStatus'] == 7) {
		$sub_array[] = 'TRANSFER FROM LITIGATION TO ROPA';
	}else if($row['letterStatus'] == 8) {
		$sub_array[] = 'ANNOTATION OF COS';
	}else if($row['letterStatus'] == 9) {
		$sub_array[] = 'PREPARE TO CONSOLIDATION IN THE NAME OF THE BANK';
	}else{
		$sub_array[] = $row['letterStatus'];
	}
	
	if($row['duecDLate'] >= 1){
		// $sub_array[] = "<a href='javascript:void(0);' data-id='" . $row['id'] . "' value='" . $row['duecProdType'] . "' class='btn btn-primary btn-sm btnCheckC'>Upload</a>";
		$sub_array[] = "<button style='display: inline;' class='btn btn-primary btn-sm btnCheckC'  id='" . $row['loan_Id'] . "' name='results' value='" . $row['salaryType'] . "' type='button'>OPEN</button>
						<button class='btn btn-danger btn-sm btnPR'  id='" . $row['loan_Id'] . "' data-id = '" . $row['loan_Id']. "' name='remind'  type='button'>REMARKS</button>";
	}else{
		if($_SESSION['username'] == 'ctborgonia' || $_SESSION['username'] == 'jcvillanueva' || $_SESSION['username'] == 'jalvarez' || $_SESSION['position'] == 'BM' || $_SESSION['department'] == 6
		   || $_SESSION['username'] == 'eecesar' || $_SESSION['username'] == 'cgluda' || $_SESSION['username'] == 'hmmendoza' || $_SESSION['username'] == 'jlcvalero'){
			$sub_array[] = "<button class='btn btn-primary btn-sm btnCheckC'  id='" . $row['loan_Id'] . "' name='results' value='" . $row['salaryType'] . "' type='button'>OPEN</button>
							<button class='btn btn-danger btn-sm btnRemind'  id='" . $row['loan_Id'] . "' data-id = '" . $row['loan_Id']. "' name='remind'  type='button'>REMINDER</button>
							";
		}
		else{
			if($_SESSION['username'] == 'cbasco'){
				$sub_array[] = "<button class='btn btn-primary btn-sm btnCheckC'  id='" . $row['loan_Id'] . "' name='results' value='" . $row['salaryType'] . "' type='button'>OPEN</button>";
			}else{
				$sub_array[] = '';
			}
		}
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
?>
