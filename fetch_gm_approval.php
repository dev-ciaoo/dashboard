
<?php
include('connection.php');

$imgExt = array(
    'gif',
    'jpg',
    'jpeg',
    'png'
);

$output = array();
$sql = "SELECT id, r_Name, r_Branch, r_myDate, r_Position, r_Request, r_Image, r_Status FROM `request` WHERE r_Status = 1";

$columns = array(
	0 => 'id',
	1 => 'r_Name',
	2 => 'r_Branch',
	3 => 'r_myDate',
	4 => 'r_Position',
	5 => 'r_Request',
	6 => 'r_Image',
    7 => 'r_Status'
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
	if($row['r_Status'] = 1){
		$sql .= "ORDER BY `r_Status` ASC, id";
	}else{
		$sql .= "ORDER BY id ASC";
	}
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
	$sub_array[] = $row['id'];
	$sub_array[] = $row['r_Name'];
	$sub_array[] = $row['r_Branch'];
	$sub_array[] = $row['r_myDate'];
	$sub_array[] = $row['r_Request'];
	if($row['r_Status'] == 0) {
		$sub_array[] = 'Requesting Head/BM Approval';
	}
	else if($row['r_Status'] == 1) {
		$sub_array[] = 'Requesting for GM/AGM Approval';
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
	else if($row['r_Status'] == 6) {
		$sub_array[] = "Head/BM approved";
	}
	else {
		$sub_array[] = '';
	}
	if($row['r_Image'] != 'request/d41d8cd98f00b204e9800998ecf8427e.'){
		$ext = strtolower(pathinfo($row['r_Image'], PATHINFO_EXTENSION));
		if(in_array($ext, $imgExt)){
			$sub_array[] = '<a target="_blank" href="' . $row['r_Image'] . '"><img src="./statusImage/photoIcon.png" style="width: 45%; height: auto;"/></a>';
		}
		else{
			$sub_array[] = '<a target="_blank" href="' . $row['r_Image'] . '"><img src="./statusImage/pdfIcon.png" style="width: 45%; height: auto;"/></a>';
		}
	}
	else{
		$sub_array[] = '';
	}
    // if($row['r_Position'] == 'Staff') {
		if($row['r_Status'] == 1)
			$sub_array[] = '<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-outline-success btn-sm btnCheckk">Approve</a> 
							<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-outline-danger btn-sm btnXx">Disapprove</a>';
		else {
			$sub_array[] = '';
		}
    // }else if($row['r_Position'] != 'Staff'){
	// 	$sub_array[] = '';
	// }
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
