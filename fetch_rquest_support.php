
<?php
include('connection.php');

$imgExt = array(
    'gif',
    'jpg',
    'jpeg',
    'png'
);

$output = array();
$sql = "SELECT * FROM `request` WHERE r_Status = 6";

$columns = array(
	0 => 'id',
	1 => 'r_Name',
	2 => 'r_Branch',
	3 => 'r_myDate',
	4 => 'r_Request',
	5 => 'r_Status',
	6 => 'r_timeApproved',
    7 => 'r_Image',
	8 => 'r_PriorityLevel',
	9 => 'r_AssignTo'
);

if (isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " AND (r_Name LIKE '%" . $search_value . "%'";
	$sql .= " OR r_Branch LIKE '%" . $search_value . "%')";
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
	$sub_array[] = html_entity_decode($row['r_Request']);
	if($row['r_Status'] == 0) {
		$sub_array[] = 'Requesting Head/BM Approval';
	}else if($row['r_Status'] == 1) {
		$sub_array[] = 'Requesting for GM/AGM Approval';
	}else if($row['r_Status'] == 2) {
		$sub_array[] = "IT's Working on it";
	}else if($row['r_Status'] == 3) {
		$sub_array[] = "IT's Done with the Request.";
	}else if($row['r_Status'] == 4) {
		$sub_array[] = "IT Request Completed";
	}else if($row['r_Status'] == 5) {
		$sub_array[] = "Rejected";
	}else if($row['r_Status'] == 6 && $row['r_approver'] === 'jalvarez') {
		$sub_array[] = "Approved by GM";
	}else if($row['r_Status'] == 6){
		$sub_array[] = "Approved by Head/BM";
	}
	else {
		$sub_array[] = '';
	}
	$sub_array[] = $row['r_timeApproved'];
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
	$sub_array[] = '<form method="post" id="pForm_' . $row['id'] . '">
						<select name="pLevel_' . $row['id'] . '" class="form-control pLevel" id="pLevel_' . $row['id'] . '" style="font-size: 14px; text-align: center;">
							<option value="1">RED</option>
							<option value="2">ORANGE</option>
							<option value="3">YELLOW</option>
							<option value="4">GREEN</option>
							<option value="5">BLUE</option>
						</select>
					</form>';
	$sub_array[] = '<form method="post" id="assignForm_' . $row['id'] . '">
						<select name="assignTo_' . $row['id'] . '" class="form-control assignTo" id="assignTo_' . $row['id'] . '" style="font-size: 14px; text-align: center;">
							<option value="JCV">JCV</option>
							<option value="Kris">Kris</option>
							<option value="Ivan">Ivan</option>
							<option value="Jhay-Ar">Jhay-Ar</option>
							<option value="Jermay">Jermay</option>
						</select>
					</form>';
	if($row['r_Status'] == 6 && $row['r_approver'] !== 'jalvarez'){
		$sub_array[] = '<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-success btn-sm btnCheck">Approve</a> 
						<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-info btn-sm btnTrans">Transfer</a> 
						<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-danger btn-sm btnX">Disapprove</a>';
	}
	else if($row['r_Status'] == 6){
		$sub_array[] = '<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-success btn-sm btnCheck">Approve</a> 
						<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-info btn-sm btnTrans disabled">Transfer</a> 
						<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-danger btn-sm btnX">Disapprove</a>';
	}
	else {
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
