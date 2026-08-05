<?php
include('connection.php');

$output = array();

$corpId = $_POST['corpId'];
$sql = "SELECT a_csupplierContact, a_cdateUpload, ac_remarks FROM corparchive WHERE a_csupplierContact <> '' AND a_corpLoanId = '$corpId' ";

$columns = array(
	0 => 'a_corpId',
    1 => 'a_corpLoanId',
    2 => 'a_csupplierContact',
	3 => 'ac_remarks',
	4 => 'a_cdateUpload'
);

if (isset($_POST['order'])) {
	$column_index = $_POST['order'][0]['column'];
	$order_direction = $_POST['order'][0]['dir'];
	$column_name = $columns[$column_index];
	$sql .= " ORDER BY " . $column_name . " " . $order_direction;
} else {
	$sql .= " ORDER BY a_corpId ASC";
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
	// $sub_array[] = '<a href="http://localhost/dashboard/' . $row['a_csupplierContact'] . '" target="_blank"><button class="btn btn-primary btn-sm">Open File</button></a>';
	$sub_array[] = '<a href="http://10.10.10.120/dashboard/' . $row['a_csupplierContact'] . '" target="_blank"><button class="btn btn-primary btn-sm">Open File</button></a>';
	if($row['ac_remarks'] != ''){
		$sub_array[] = $row['ac_remarks'];
	}else{
		$sub_array[] = '';
	}
	$sub_array[] = $row['a_cdateUpload'];
	
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
