
<?php
include('connection.php');

$imgExt = array(
    'gif',
    'jpg',
    'jpeg',
    'png'
);

$output = array();

$sql = "SELECT d.departmentName, r.* FROM `accounts` as a 
                INNER JOIN `department` as d  ON d.id = a.userDepartment
                INNER JOIN `request` as r ON r.r_user_Id = a.userId
                WHERE d.id = '". $_SESSION['department'] ."'
					AND a.address = '" . $_SESSION['address'] . "'
					AND r.r_Status IN (0, 2, 3, 7) AND a.userPosition = 'Staff' 
		";


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
	
	// if($row['r_Position'] != 'Staff'){
	// 	$sql .= " AND r_Status = 1 ";
	// }
	// else {
	// 	$sql .= " OR r_Status = 6 ";
	// }
}

if (isset($_POST['order'])) {
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY r." . $columns[$column_name] . " " . $order . "";
} 
else {
	if($row['r_Status'] = 7){
		$sql .= "ORDER BY `r_Status` DESC, id";
	}else{
		$sql .= "ORDER BY `id` ASC, `r_Status`";
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
	else if($row['r_Status'] == 6) {
		$sub_array[] = "Head/BM approved";
	}
	else if($row['r_Status'] == 7){
		$sub_array[] = "Head/BM Followed Up";
	}
	else if($row['r_Status'] == 0) {
		$sub_array[] = "Staff Requesting for Approval";
	}
	else {
		$sub_array[] = '';
	}

	// $ext=".pdf";

	// function endsWith($img, $ext){
	// 	$extLength = strlen($ext);
	// 	if(substr($img, -$extLength) == $ext){
	// 		return true;
	// 	}
	// 	return false;
	// } 
	// If(endsWith($row['img'], ".pdf")){ //executes if return is true
	
	// echo '<img src="http://example.com/image.png" /></a><p>';
	// }
	// else
	// {   //executes if return is false
	// echo '<img src="http://example.com/upload/' .  $row['img'] . '" /></a><p>';
	
	// }
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
	if($row['r_Status'] == 0){
		$sub_array[] = '<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-success btn-sm btnApp">Approve</a> 
						<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-danger btn-sm btnRej">Disapprove</a>';
    }else {
		if($row['r_Status'] == 3){
				$sub_array[] = '<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-info btn-sm btnServiceR">Service Render</a>';
		}
		else if($row['r_Status'] == 2){
			$sub_array[] = '<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-warning btn-sm btnFollowUp">Follow Up</a>';
		}
		else {
			$sub_array[] = '';
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
