
<?php
include('connection.php');

$imgExt = array(
    'gif',
    'jpg',
    'jpeg',
    'png'
);


$output = array();

    $sql = "SELECT * FROM disposal";

$columns = array(
	0 => 'id',
	1 => 'fullName',
	2 => 'branch',
	3 => 'preparedDate',
	4 => 'ffeDisc',
	5 => 'r_Request',
	6 => 'stats'
);

if (isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE (fullName like '%" . $search_value . "%'";
    $sql .= " OR branch like '%" . $search_value . "%'";
	$sql .= " OR ffeDisc like '%" . $search_value . "%')";
	
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
	$sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
} 
else {
	// if($row['stats'] = 3){
		$sql .= "ORDER BY `stats` DESC, id";
	// }else{
	// 	$sql .= "ORDER BY `id` ASC, `stats`";
	// }
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

date_default_timezone_set('Asia/Manila');
    // $dateTimee = $row['dateToday'];
    // $partss = explode("@", $dateTimee);
    // $dateOnlyy = trim($partss[0]);

	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['fullName'];
	$sub_array[] = $row['branch'];

	$sub_array[] = $row['dateToday'];
	$sub_array[] = '<a href="http://localhost/dashboard/ffeDisposalStatusForm.php?id=' . $row['id'] . '" target="_blank">'
             . htmlspecialchars($row['ffeDisc']) .
             '</a>';
	if($row['stats'] == 0) {
		$sub_array[] = '<span class="badge bg-primary"> Waiting for Item Review</span>';
	}
	else if($row['stats'] == 1) {
		$sub_array[] = '<span class="badge bg-primary"> Waiting for Item Bid</span>';
	}
	else if($row['stats'] == 2) {
		$sub_array[] = '<span class="badge bg-primary"> Waiting for GM Approval</span>';
	}
	else if($row['stats'] == 3) {
		$sub_array[] = '<span class="badge bg-success">Item is disposed successfully</span>';
    }else{
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
