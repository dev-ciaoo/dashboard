
<?php
include('connection.php');

$output = array();

$time_24hr = $row['setTime']; // assuming 'setTime' is in 'H:i:s' format
$time_12hr = date("h:i A", strtotime($time_24hr));
$sql = "SELECT d.*, a.* FROM duecalendar AS d
                        JOIN accounts AS a ON a.userId = d.calendar_sender";

$columns = array(
	0 => 'id',
	1 => 'calendar_userName',
	2 => 'calendar_userEmail',
	3 => 'calendar_msg',
	4 => 'calendar_sender',
	5 => 'calendar_receiver',
	6 => 'calendar_stats',
	7 => 'dateToday',
	8 => 'setTime',
	9 => 'dateTime',
	10 => 'receiver_stats',
	11 => 'updateStats'
);

$search_value = $_POST['search']['value'];

if(isset($search_value)) {
	$sql .= " WHERE (d.calendar_userEmail like '" . $search_value . "'";
    $sql .= " OR a.fullName like '%" . $search_value . "%'";
	$sql .= " OR d.dateToday like '%" . $search_value . "%'";
	$sql .= " OR d.calendar_msg like '%" . $search_value . "%')";

}

if(isset($_POST['order'])) {
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY d." . $columns[$column_name] . " " . $order . "";
}else{
    $sql .= "ORDER BY d.id ASC";
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
    $sub_array[] = $row['fullName'];
	$sub_array[] = $row['calendar_userEmail'];
	$sub_array[] = $row['calendar_msg'];
	$sub_array[] = $row['dateToday'];
    if($row['setTime']){
        $time_24hr = $row['setTime']; // assuming 'setTime' is in 'H:i:s' format
        $sub_array[] = $time_12hr = date("h:i A", strtotime($time_24hr));
    }
	$sub_array[] = $row['dateTime'];
	
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