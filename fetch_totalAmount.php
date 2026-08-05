<?php
include('connection.php');

$output = array();
// $branchh = $_POST['branchch'];
$sql = "SELECT * FROM `duecollection` as d
					WHERE duecProdType <> 'SCR'
							AND (
									(duecProdType NOT IN ('Microfinance Loan', 'Microfinance Plus',
									'Salary Loan', 'Employee Loan') AND duecDLate >= 31) OR 
									(duecProdType IN ('Microfinance Loan', 'Microfinance Plus') AND duecDLate >= 8) OR
									(duecProdType IN ('Salary Loan', 'Employee Loan') AND duecDLate >= 16)
								)
		";

$columns = array(
	0 => 'id',
	1 => 'duecLoanId',
	2 => 'duecBranch',
	3 => 'duecProdID',
	4 => 'duecBName',
	5 => 'duecContact',
	6 => 'duecStatus',
	7 => 'duecProdType',
	8 => 'duecLoanG',
    9 => 'duecLoanM',
	10 => 'duecDueDate',
	11 => 'duecDLate',
	12 => 'duecPrincipalAmount',
	13 => 'duecPrincipalDue',
	14 => 'duecAmountDue',
    15 => 'duecOverDue',
    16 => 'duecAccBal',
    17 => 'duecLastUnpaid',
    18 => 'dStatus',
    19 => 'dateImported'
);

if (isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " AND (d.duecBranch LIKE '%" . $search_value . "%'";
	$sql .= " OR d.duecProdID LIKE '%" . $search_value . "%'";
	$sql .= " OR d.duecBName LIKE '%" . $search_value . "%')";

	if ($_SESSION['position'] == 'BM' && $_SESSION['address'] != 'Head Office') {
		$sql .= " AND (d.duecBranch = '" . $_SESSION['address'] . "')";
	} else {
		if ($_SESSION['position'] == 'BM' && $_SESSION['address'] == 'Head Office') {
			$sql .= " AND (d.duecBranch = 'Head Office')";
		}
	}
} else {
	if ($_SESSION['position'] == 'BM' && $_SESSION['address'] != 'Head Office') {
		$sql .= " AND (d.duecBranch = '" . $_SESSION['address'] . "')";
	} else {
		if ($_SESSION['position'] == 'BM' && $_SESSION['address'] == 'Head Office') {
			$sql .= " AND (d.duecBranch = 'Head Office')";
		}
	}
}

if(isset($_POST['branchh']) && !empty($_POST['branchh'])){
	$branchh = mysqli_real_escape_string($con, $_POST['branchh']);
	$sql .= " AND d.duecBranch = '$branchh'";
}


if (isset($_POST['order'])) {
	$column_index = $_POST['order'][0]['column'];
	$order_direction = $_POST['order'][0]['dir'];
	$column_name = $columns[$column_index];
	$sql .= " ORDER BY d." . $column_name . " " . $order_direction;
} else {
	$sql .= " ORDER BY d.duecDLate ASC, d.id";
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
	$sub_array[] = $row['duecProdID'];
	$sub_array[] = $row['duecBName'];
	$sub_array[] = $row['duecProdType'];
	$sub_array[] = number_format($row['duecPrincipalBal'], 2, '.', ',');
	$sub_array[] = number_format($row['duecTotalAmountDue'], 2, '.', ',');
	$sub_array[] = $row['duecDLate'];

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
