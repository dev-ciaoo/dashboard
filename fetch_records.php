
<?php
include('connection.php');

$output = array();
$sql = "SELECT * FROM `amlc`";

$columns = array(
	0 => 'id',
	1 => 'recordUserId',
	2 => 'recordName',
	3 => 'recordDateTime'
);

if (isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE (recordUserId like '%" . $search_value . "%'";
	$sql .= " OR recordName like '%" . $search_value . "%')";
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
	$sub_array[] = $row['id'];
	$sub_array[] = $row['recordName'];
	$sub_array[] = $row['recordSearch'];
	$sub_array[] = $row['recordDateTime'];

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