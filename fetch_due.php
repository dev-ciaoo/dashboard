<?php
include('connection.php');

$output = array();

// $branchh = $_POST[]
$sql = "SELECT c.* FROM `collectionarchive` as c
						LEFT JOIN duecollection as d ON d.duecLoanId = c.colLoanId
						WHERE d.duecLoanId IS NULL AND c.colStatus <> 'a' 
							AND (
									(c.colProdType NOT IN ('Microfinance Loan', 'Microfinance Plus', 'Salary Loan', 'Employee Loan') AND c.colDueLate >= 31) OR 
									(c.colProdType IN ('Microfinance Loan', 'Microfinance Plus') AND c.colDueLate >= 8) OR
									(c.colProdType IN ('Salary Loan', 'Employee Loan') AND c.colDueLate >= 16)
							  	)
		";

$columns = array(
	0 => 'id',
	1 => 'colLoanId',
	2 => 'colBranch',
	3 => 'colProdId',
    4 => 'colBName',
	5 => 'colContact',
	6 => 'colStatus',
	7 => 'colProdType',
	8 => 'colLoanG',
	9 => 'colLoanM',
	10 => 'colDueDate',
	11 => 'colDueLate',
	12 => 'colPrincipalAmount',
	13 => 'colPrincipalBal',
	14 => 'colPrincipalDue',
	15 => 'colInterest',
	16 => 'colPenalty',
	17 => 'colTotalAmountDue',
	18 => 'colLastUnpaid',
	19 => 'coldStatus',
	20 => 'coldateImported'
);

if (isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " AND (c.colBranch LIKE '%" . $search_value . "%'";
	$sql .= " OR c.colProdId LIKE '%" . $search_value . "%'";
	$sql .= " OR c.colBName LIKE '%" . $search_value . "%')";

	if ($_SESSION['position'] == 'BM' && $_SESSION['address'] != 'Head Office') {
		$sql .= " AND (c.colBranch = '" . $_SESSION['address'] . "')";
	} else {
		if ($_SESSION['position'] == 'BM' && $_SESSION['address'] == 'Head Office') {
			$sql .= " AND (c.colBranch = 'Head Office')";
		}
	}
} else {
	if ($_SESSION['position'] == 'BM' && $_SESSION['address'] != 'Head Office') {
		$sql .= " AND (c.colBranch = '" . $_SESSION['address'] . "')";
	} else {
		if ($_SESSION['position'] == 'BM' && $_SESSION['address'] == 'Head Office') {
			$sql .= " AND (c.colBranch = 'Head Office')";
		}
	}
}

if (isset($_POST['order'])) {
	$column_index = $_POST['order'][0]['column'];
	$order_direction = $_POST['order'][0]['dir'];
	$column_name = $columns[$column_index];
	$sql .= " ORDER BY c." . $column_name . " " . $order_direction;
} else {
	$sql .= " ORDER BY c.colDueLate ASC, c.id";
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
	$sub_array[] = $row['colBranch'];
	$sub_array[] = $row['colProdId'];
	$sub_array[] = $row['colBName'];
	$sub_array[] = $row['colStatus'];
	$sub_array[] = number_format($row['colPrincipalBal'], 2, '.', ',');
	$sub_array[] = number_format($row['colTotalAmountDue'], 2, '.', ',');
	$sub_array[] = $row['colDueLate'];

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
