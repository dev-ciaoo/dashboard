<?php
include('connection.php');

$output = array();

$micId = $_POST['micId'];
$sql = "SELECT a_loanInstallment, a_mdateUploaded, am_remarks FROM microarchive WHERE a_loanInstallment <> '' AND a_mLoan_Id = '$micId'";

$columns = array(
	0 => 'id',
    1 => 'a_mLoan_Id',
    2 => 'a_loanInstallment',
	3 => 'am_remarks',
	4 => 'a_mdateUploaded'
);

if (isset($_POST['order'])) {
	$column_index = $_POST['order'][0]['column'];
	$order_direction = $_POST['order'][0]['dir'];
	$column_name = $columns[$column_index];
	$sql .= " ORDER BY " . $column_name . " " . $order_direction;
} else {
	$sql .= " ORDER BY id ASC";
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
	// $sub_array[] = '<a href="http://localhost/dashboard/' . $row['a_loanInstallment'] . '" target="_blank"><button class="btn btn-primary btn-sm">Open File</button></a>';
	$sub_array[] = '<a href="http://10.10.10.120/dashboard/' . $row['a_loanInstallment'] . '" target="_blank"><button class="btn btn-primary btn-sm">Open File</button></a>';
	if($row['am_remarks'] != ''){
		$sub_array[] = $row['am_remarks'];
	}else{
		$sub_array[] = '';
	}
	$sub_array[] = $row['a_mdateUploaded'];

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
