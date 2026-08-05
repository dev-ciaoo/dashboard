
<?php
include('connection.php');

$output = array();
$sql = "SELECT i.*, c.categoryCode FROM inventory i INNER JOIN categorytbl c ON c.id = i.category
									WHERE i.isDeleted <> 1";

$columns = array(
	0 => 'id',
	1 => 'computer',
	2 => 'code',
	3 => 'location',
	4 => 'description',
	5 => 'connectivity',
	6 => 'conditions',
	7 => 'quantity',
	8 => 'serials',
	9 => 'price',
	10 => 'img',
	11 => 'dateAdded',
	12 => 'dateTransfer',
	13 => 'fname',
	14 => 'status'
);

if(isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " AND (i.id like '" . $search_value . "'";
	$sql .= " OR i.code like '%" . $search_value . "%'";
	$sql .= " OR i.computer like '%" . $search_value . "%'";
	$sql .= " OR i.serials like '%" . $search_value . "%'";
	$sql .= " OR i.connectivity like '%" . $search_value . "%'";
	$sql .= " OR i.fname like '%" . $search_value . "%'";
	$sql .= " OR i.dateTransfer like '%" . $search_value . "%'";
	$sql .= " OR i.location like '%" . $search_value . "%')";

	if($_SESSION['role'] == 'user') {
		$sql .= " AND (i.status <> 2) AND (i.location = '".$_SESSION['address']."')";
	}
}
else {
	if($_SESSION['role'] == 'user') {
		$sql .= " WHERE (i.status <> 2) AND (i.location = '".$_SESSION['address']."')";
	}
}

if(isset($_POST['order'])) {
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY i." . $columns[$column_name] . " " . $order . "";
} 
else{
	if($row['priority'] = 1) {
			// sorting the priority to descending, then the id sort by ascending
		$sql .= "ORDER BY `priority` ASC, i.id DESC";
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
$data = array();
while ($row = mysqli_fetch_assoc($query)) {
	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['computer'];
	$sub_array[] = $row['categoryCode'].'_0'.$row['code_id'];
	$sub_array[] = $row['location'];
	$sub_array[] = $row['description'];
	$sub_array[] = $row['connectivity'];
	$sub_array[] = $row['conditions'];
	$sub_array[] = $row['quantity'];
	$sub_array[] = $row['serials'];
	$sub_array[] = $row['price'];
	$sub_array[] = '<a target="_blank" href="' . $row['img'] . '"><img src="' . $row['img'] . '" style="width: 30%; height: auto;"/></a>';
	$sub_array[] = date('F j, Y', strtotime($row['dateAdded']));
	$sub_array[] = $row['dateTransfer'];
	$sub_array[] = $row['fname'];
	if($row['status'] == 0) {
		$sub_array[] = "No";
	}
	else if ($row['status'] == 1) {
		$sub_array[] = "Waiting for Approval";
	}
	else if($row['status'] == 2) {
		$sub_array[] = "Yes";
	}
	else {
		$sub_array[] = "";
	}
	if ($_SESSION['role'] == 'admin' && $_SESSION['department'] == 1) {
		if($row['status'] != 2) {
			$button =		'<div style="display: inline-block;"><a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-info btn-sm editbtn">&nbsp;&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
								<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-danger btn-sm deleteBtn">&nbsp;&nbsp;&nbsp;Delete&nbsp;&nbsp;&nbsp;</a>
								<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-secondary btn-sm transferBtn">&nbsp;&nbsp;Transfer&nbsp;&nbsp;</a>
								<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-success btn-sm disposalBtn">&nbsp;&nbsp;Disposal&nbsp;&nbsp;</a>
							</div>';
			$button .=  	($row['status'] == 1) ? '<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-warning btn-sm disapproveBtn">Disapprove</a>
							<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-primary btn-sm approveBtn">&nbsp;&nbsp;Approve&nbsp;</a>' : '';		
			$sub_array[] =  $button;
		}else{
			$sub_array[] = "";
		}
	}else if($_SESSION['username'] == 'mdgloria'){
		if($row['status'] != 2) {
			$button =		'<div style="display: inline-block;"><a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-info btn-sm editbtn">&nbsp;&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
								<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-danger btn-sm deleteBtn">&nbsp;&nbsp;&nbsp;Delete&nbsp;&nbsp;&nbsp;</a>
								<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-secondary btn-sm transferBtn">&nbsp;&nbsp;Transfer&nbsp;&nbsp;</a>
								<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-success btn-sm disposalBtn">&nbsp;&nbsp;Disposal&nbsp;&nbsp;</a>
							</div>';
			$button .=  	($row['status'] == 1) ? '<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-warning btn-sm disapproveBtn">Disapprove</a>
							<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-primary btn-sm approveBtn">&nbsp;&nbsp;Approve&nbsp;</a>' : '';		
			$sub_array[] =  $button;
		}else{
			$sub_array[] = "";
		}
	}else if($_SESSION['role'] == 'admin' && $_SESSION['department'] == 2){
		if($row['status'] != 2) {
			$button =		'';
			$button .=  	($row['status'] == 1)?'<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-warning btn-sm disapproveBtn">Disapprove</a>
							<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-primary btn-sm approveBtn">&nbsp;&nbsp;Approve&nbsp;</a>':"";		
			$sub_array[] =  $button;
		}else{
			$sub_array[] = "";
		}
	}else {
		if($row['status'] == 0) {
			$sub_array[] = '<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-danger btn-sm disposalBtn">Disposal</a>';
		}
		else {
			$sub_array[] = "";
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