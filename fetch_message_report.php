
<?php
include('connection.php');

$imgExt = array(
    'gif',
    'jpg',
    'jpeg',
    'png'
);
$output = array();
$sql = "SELECT a.*, c.* FROM chatbox AS c
				 JOIN accounts as a ON a.userId = c.receiver";
$columns = array(
	0 => 'id',
	1 => 'username',
	2 => 'text1',
	3 => 'sender',
	4 => 'receiver',
	5 => 'archived',
	6 => 'trash',
	7 => 'notif',
	8 => 'myDate',
	9 => 'time'
);

if (isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE (c.username LIKE '%" . $search_value . "%'";
	$sql .= " OR c.sender LIKE '%" . $search_value . "%'";
	$sql .= " OR c.receiver LIKE '%" . $search_value . "%')";
}

if (isset($_POST['order'])) {
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY c." . $columns[$column_name] . " " . $order . "";
} 
else {
	$sql .= "ORDER BY c.time DESC";
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
	$sub_array[] = $row['username'];
	$sub_array[] = $row['text1'];
	// $sub_array[] = $row['sender'];
	$sub_array[] = $row['fullName'];
	$sub_array[] = $row['myDate'] . ' @ ' . $row['time'];

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