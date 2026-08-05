
<?php
include('connection.php');

$output = array();
$sql = "SELECT a.*, e.empStatus FROM `accounts` AS a 
										LEFT JOIN empinfo AS e ON a.employeeId = e.empId 
											WHERE `stats` <> 1";

$columns = array(
	0 => 'fullName',
	1 => 'address',
	2 => 'VL',
    3 => 'SL',
    4 => 'ML',
	5 => 'EL',
	6 => 'UL'
);

if (isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " AND (a.fullName LIKE '%" . $search_value . "%'";
	$sql .= " OR a.address LIKE '%" . $search_value . "%')";
}

if (isset($_POST['order'])) {
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY a." . $columns[$column_name] . " " . $order . "";
} 
else {
	$sql .= "ORDER BY a.userId ASC";
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
	$sub_array[] = $row['fullName'];
	$sub_array[] = $row['address'];
	if($row['empStatus'] !== 'Probationary'){
		$sub_array[] = $row['VL'];
		$sub_array[] = $row['ML'];
		$sub_array[] = $row['SL'];
		$sub_array[] = $row['EL'];
	}else{
		$sub_array[] = '0';
		$sub_array[] = '0';
		$sub_array[] = '0';
		$sub_array[] = '0';
	}
	$sub_array[] = $row['UL'];


	if($_SESSION['userid'] == 8){
		$sub_array[] =  '
						<a href="javascript:void(0);" data-id="' . $row['userId'] . '" class="btn btn-info btn-sm editbtn">
							<span class="fa-regular fa-pen-to-square"></span>
						</a>
						<a href="javascript:void(0);" data-id="' . $row['userId'] . '" class="btn btn-danger btn-sm deleteBtn">
							<span class="fa-solid fa-user-minus"></span>
						</a>
					';
	}else{
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