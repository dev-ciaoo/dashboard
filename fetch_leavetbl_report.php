<?php
include('connection.php');

$output = array();

$sql = "SELECT * FROM leavetbl WHERE user_id = '" . $_SESSION['userid'] . "' ";

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

// SEARCH
if (isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " AND (iCategory LIKE '%$search_value%' 
			   OR dateFrom LIKE '%$search_value%')";
}

// ORDER
if(isset($_POST['order'])) {
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY " . $columns[$column_name] . " " . $order;
}else{
	$sql .= " ORDER BY id DESC";
}

// SAVE query BEFORE limit (for counting)
$count_query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($count_query);

// LIMIT (AFTER ORDER)
if ($_POST['length'] != -1) {
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT $start, $length";
}

// FINAL QUERY
$query = mysqli_query($con, $sql);

$data = array();

while ($row = mysqli_fetch_assoc($query)) {
	$sub_array = array();
	$sub_array[] = $row['iName'];
	// $sub_array[] = $row['employee_Id'];
	$sub_array[] = $row['iBranch'];
	$sub_array[] = $row['iCategory'];
	$sub_array[] = date('m-d-Y', strtotime($row['dateFrom']));
	$sub_array[] = date('m-d-Y', strtotime($row['dateTo']));
	$sub_array[] = date("h:i A", strtotime($row['timeFrom']));
	$sub_array[] = date("h:i A", strtotime($row['timeTo']));

	if($row['iCategory'] != 'Overtime'){
		if($row['workingDays'] == 0){
			$sub_array[] = '-';
		}else{
			$sub_array[] = $row['workingDays'] . ' Day/s';
		}
	}else{
		$sub_array[] = $row['totalHours'] . ' Hour/s';
	}

	$sub_array[] = html_entity_decode($row['iMessage']);
	if($row['iStatus'] == 1){
		$sub_array[] = '<span class="badge bg-info"><i>PENDING</i></span>';
	}elseif($row['iStatus'] == 2){
		$sub_array[] = '<span class="badge bg-success"><i>APPROVED</i></span>';
	}else{
		$sub_array[] = '<span class="badge bg-danger"><i>DENIED</i></span>';
	}
	$sub_array[] = $row['iRemarks'];
	$sub_array[] = $row['approver'];
	$sub_array[] = $row['timeApproved'];

	// $sub_array[] = '<a href="javascript:void(0);" data-id="'.$row['id'].'" class="btn btn-info btn-sm editbtn">
	// 					<span class="fa-regular fa-pen-to-square"></span>
	// 				</a>
	// 				<a href="javascript:void(0);" data-id="'.$row['id'].'" class="btn btn-danger btn-sm deleteBtn">
	// 					<span class="fa-regular fa-trash-can"></span>
	// 				</a>';

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