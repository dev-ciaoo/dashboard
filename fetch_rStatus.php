
<?php
include('connection.php');

$output = array();
$sql = "SELECT id, r_Name, r_Branch, r_myDate, r_Request, r_Image, r_Status FROM `request` WHERE r_Status IN (1, 2, 3, 4 , 5, 6, 0)";

$columns = array(
	0 => 'r_Name',
	1 => 'r_Branch',
	2 => 'r_myDate',
	3 => 'r_Request',
	4 => 'r_Image',
    5 => 'r_Status'
);

if (isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " AND (r_Name like '%" . $search_value . "%'";
	$sql .= " OR r_Branch like '%" . $search_value . "%')";
}

if (isset($_POST['order'])) {
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
} 
else {
	$sql .= "ORDER BY id ASC";
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
	$sub_array[] = $row['r_Name'];
	$sub_array[] = $row['r_Branch'];
	$sub_array[] = $row['r_myDate'];
	$sub_array[] = $row['r_Request'];
	if($row['r_Status'] == 1) {
		$sub_array[] = 'Requesting for Head/BM Approval';
	}
	else if($row['r_Status'] == 2) {
		$sub_array[] = "IT's are working on it";
	}
	else if($row['r_Status'] == 3) {
		$sub_array[] = "IT's are done working on it";
	}
	else if($row['r_Status'] == 4) {
		$sub_array[] = "IT Request are Completed";
	}
	else if($row['r_Status'] == 5) {
		$sub_array[] = "Head/BM/Staff request are rejected";
	}
	else {
		$sub_array[] = '';
	}
	if($row['r_Image'] != 'request/d41d8cd98f00b204e9800998ecf8427e.'){
		$sub_array[] = '<a target="_blank" href="' . $row['r_Image'] . '"</a><img src="' . $row['r_Image'] . '" style="width: 20%; height: auto;"/></a>';
	}
	else{
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