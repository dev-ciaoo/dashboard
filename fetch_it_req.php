
<?php
include('connection.php');

$imgExt = array(
    'gif',
    'jpg',
    'jpeg',
    'png'
);

$output = array();
$sql = "SELECT * FROM `request` WHERE r_Status IN (2, 3, 7)";

$columns = array(
	0 => 'id',
	1 => 'r_user_Id',
	2 => 'r_employee_Id',
	3 => 'r_Name',
	4 => 'r_Branch',
	5 => 'r_myDate',
	6 => 'r_toEmail',
	7 => 'r_Request',
	8 => 'r_Image',
	9 => 'r_PriorityLevel',
	10 => 'r_AssignTo',
	11 => 'r_Status'
);


if(isset($_POST['order'])) {
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
}else{
	if($row['r_Priority'] == 1){
		$sql .= "ORDER BY `r_Priority` DESC, `r_Status`";
	}else{
			$sql .= "ORDER BY `r_Status` ASC, id DESC";
	}
}

if($_POST['length'] != -1) {
	$start = $_POST['start'];
	$length = $_POST['length'];
	$limit_condition_sql = $sql;
	$limit_condition_sql .= " LIMIT  " . $start . ", " . $length . "";
}

$query = mysqli_query($con, $limit_condition_sql);
$count_query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($count_query);
// print_r(mysqli_query($con, $sql));
// die();
$data = array();
while ($row = mysqli_fetch_assoc($query)) {
	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['r_Name'];
	$sub_array[] = $row['r_Branch'];
	$sub_array[] = $row['r_myDate'];
	$sub_array[] = html_entity_decode($row['r_Request']);
	if($row['r_Status'] == 1) {
		$sub_array[] = 'Requesting Head/BM Approval';
	}
	else if($row['r_Status'] == 2) {
		$sub_array[] = "IT's Working on it";
	}
	else if($row['r_Status'] == 3) {
		$sub_array[] = "IT's Done with the Request.";
	}
	else if($row['r_Status'] == 4) {
		$sub_array[] = "IT Request Completed";
	}
	else if($row['r_Status'] == 5) {
		$sub_array[] = "Rejected";
	}
	else if($row['r_Status'] == 7){
		$sub_array[] = "Head/BM Followed Up";
	}
	else {
		$sub_array[] = '';
	}
	if($row['r_Image'] != 'request/d41d8cd98f00b204e9800998ecf8427e.'){
		$ext = strtolower(pathinfo($row['r_Image'], PATHINFO_EXTENSION));
		if(in_array($ext, $imgExt)){
			$sub_array[] = '<a target="_blank" href="' . $row['r_Image'] . '"><img src="./statusImage/photoIcon.png" style="width: 30%; height: auto;"/></a>';
		}
		else{
			$sub_array[] = '<a target="_blank" href="' . $row['r_Image'] . '"><img src="./statusImage/pdfIcon.png" style="width: 30%; height: auto;"/></a>';
		}
	}
	else{
		$sub_array[] = '';
	}

	$sub_array[] = $row['r_PriorityLevel'];
	$sub_array[] = $row['r_AssignTo'];
	
	if($row['r_Status'] == 2 || $row['r_Status'] == 7) {
			$sub_array[] = '<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-success btn-sm btnDone">Work Done</a>';
	}else {
			$sub_array[] = "";
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