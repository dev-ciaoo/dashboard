
<?php
include('connection.php');

$imgExt = array(
    'gif',
    'jpg',
    'jpeg',
    'png'
);
$output = array();
$sql = "SELECT r_Name, r_Branch, r_myDate, r_Request, r_Image, r_approver, r_timeApproved FROM `request` WHERE r_Status = 4";

$columns = array(
	0 => 'r_Name',
	1 => 'r_Branch',
	2 => 'r_myDate',
	3 => 'r_Request',
	4 => 'r_Image',
	5 => 'r_approver',
	6 => 'r_timeApproved'
);

if (isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " AND (r_Name LIKE '%" . $search_value . "%'";
	$sql .= " OR r_Request LIKE '%" . $search_value . "%'";
	$sql .= " OR r_AssignTo LIKE '%" . $search_value . "%'";
	$sql .= " OR r_Branch LIKE '%" . $search_value . "%')";
}

if (isset($_POST['order'])) {
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
} 
else {
	$sql .= "ORDER BY id DESC";
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
	if($row['r_Image'] != 'request/d41d8cd98f00b204e9800998ecf8427e.'){
		$ext = strtolower(pathinfo($row['r_Image'], PATHINFO_EXTENSION));
		if(in_array($ext, $imgExt)){
			$sub_array[] = '<a target="_blank" href="' . $row['r_Image'] . '"><img src="./statusImage/photoIcon.png" style="width: 45%; height: auto;"/></a>';
		}
		else{
			$sub_array[] = '<a target="_blank" href="' . $row['r_Image'] . '"><img src="./statusImage/pdfIcon.png" style="width: 45%; height: auto;"/></a>';
		}
	}else{
		$sub_array[] = '';
	}
	$sub_array[] = $row['r_approver'];
	$sub_array[] = $row['r_timeApproved'];

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