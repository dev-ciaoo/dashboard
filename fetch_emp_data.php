<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
include('connection.php');

$output = array();
$dateFROM = mysqli_real_escape_string($con, $_POST['dateFROM']);
$dateTO = mysqli_real_escape_string($con, $_POST['dateTO']);
$selectBranch = mysqli_real_escape_string($con, $_POST['selectBranch']);
$sql = "SELECT * FROM leavetbl WHERE iStatus NOT IN (1, 4) AND iAbsent <> 0";

$columns = array(
	0 => 'iName',
	1 => 'employee_Id',
	2 => 'iBranch',
	3 => 'iCategory',
	4 => 'dateFrom',
	5 => 'dateTo',
	6 => 'timeFrom',
	7 => 'timeTo',
	8 => 'workingDays',
	9 => 'totalHours',
	10 => 'kindDay',
	11 => 'kindOT',
	12 => 'iMessage',
	13 => 'approver',
	14 => 'timeApproved',
	15 => 'iRemarks'
);

// ✅ Search filter
if (isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " AND (iName LIKE '%" . $search_value . "%'";
	$sql .= " OR iCategory LIKE '%" . $search_value . "%'";
	$sql .= " OR approver LIKE '%" . $search_value . "%')";
}

// ✅ ORDER
if (isset($_POST['order'])) {
	$column_index = $_POST['order'][0]['column'];
	$order_dir = $_POST['order'][0]['dir'];
	$order_column = $columns[$column_index];
	$sql .= " ORDER BY " . $order_column . " " . $order_dir;
} else {
	$sql .= " ORDER BY id DESC";
}

// ✅ SAVE BEFORE LIMIT (important)
$base_sql = $sql;

// ✅ Pagination
if ($_POST['length'] != -1) {
	$start = intval($_POST['start']);
	$length = intval($_POST['length']);
	$sql .= " LIMIT " . $start . ", " . $length;
}

// ✅ Execute main query
$query = mysqli_query($con, $sql);

// ✅ Correct filtered count
$count_query = mysqli_query($con, $base_sql);
$count_rows = mysqli_num_rows($count_query);

$data = array();

while ($row = mysqli_fetch_assoc($query)) {
	$sub_array = array();
	$sub_array[] = $row['iName'];
	$sub_array[] = '2020-' . str_pad($row['employee_Id'], 3, '0', STR_PAD_LEFT);
	$sub_array[] = $row['iBranch'];
	$sub_array[] = $row['iCategory'];
	$sub_array[] = date('m-d-Y', strtotime($row['dateFrom']));
	$sub_array[] = date('m-d-Y', strtotime($row['dateTo']));
	$sub_array[] = date('h:i A', strtotime($row['timeFrom']));
	$sub_array[] = date('h:i A', strtotime($row['timeTo']));
	if($row['iCategory'] != 'Overtime'){
		if($row['workingDays'] == 0){
			$sub_array[] = '-';
		}else{
			$sub_array[] = $row['workingDays'] . ' Day/s';
		}
	}else{
		$sub_array[] = $row['totalHours'] . ' Hour/s';
	}
	$sub_array[] = $row['iMessage'];
	$sub_array[] = $row['iRemarks'];
	$sub_array[] = $row['approver'];
	$sub_array[] = date("F j, Y @ h:i A", strtotime($row['timeApproved']));

	if ($_SESSION['userid'] == 8) {
		$sub_array[] = '
			<a href="javascript:void(0);" data-id="' . $row['id'] . '" class="btn btn-info btn-sm editbtn">
				<span class="fa-regular fa-pen-to-square"></span>
			</a>
			<a href="javascript:void(0);" data-id="' . $row['id'] . '" class="btn btn-danger btn-sm deleteBtn">
				<span class="fa-regular fa-trash-can"></span>
			</a>';
	} else {
		$sub_array[] = '';
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
