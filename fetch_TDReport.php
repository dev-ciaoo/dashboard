
<?php
include('connection.php');

function format_number($number) {
    // Use number_format to format the number with commas for every thousand
    $formatted_number = number_format($number);
}

$output = array();
$sql = "SELECT * FROM `timedepositarchived`";

$columns = array(
	0 => 'id',
    1 => 'td_id',
	2 => 'tdaBank',
	3 => 'tdaBranch',
	4 => 'tdaBalance',
	5 => 'tdaInterest',
	6 => 'tdaTerm',
	7 => 'tdaMaturity',
	8 => 'tdaUponMaturity',
	9 => 'tdaRemarks',
	10 => 'tdaStats',
    11 => 'ddateAction'
);

if(isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE (tdaBank like '%" . $search_value . "%'";
	$sql .= " OR tdaBranch like '%" . $search_value . "%')";
}

if(isset($_POST['order'])) {
	$order_column_index = $_POST['order'][0]['column'];
    if (array_key_exists($order_column_index, $columns)) {
        $order_column_name = $columns[$order_column_index];
        $order_dir = $_POST['order'][0]['dir'];
        // Modify the SQL query to order by the selected column and direction
        $sql .= " ORDER BY $order_column_name $order_dir";
    }
}else {
	$sql .= " ORDER BY id DESC";
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
	$sub_array[] = $row['tdaBank'];
	$sub_array[] = $row['tdaBranch'];
	$sub_array[] = number_format($row['tdaBalance']) . ".00";
    $sub_array[] = $row['tdaInterest'] . "%";
	$sub_array[] = $row['tdaTerm'] . " Days";
	$sub_array[] = $row['tdaMaturity'];
	$formatted_net_interest = number_format($row['tdaUponMaturity'], 2, '.', ',');
    $sub_array[] = $formatted_net_interest;
	$sub_array[] = $row['tdaRemarks'];
	if($row['tdaStats'] == 0){
		$sub_array[] = "<span style='background-color: pink; border-radius: 25px;'><b><i>&nbsp;Transferred(OLD)&nbsp;</b></i></span>";
	}else if($row['tdaStats'] == 1){
		$sub_array[] = "<span style='background-color: lightgreen; border-radius: 25px;'><b><i>&nbsp;Transferred(NEW)&nbsp;</b></i></span>";
	}else if($row['tdaStats'] == 4){
		$sub_array[] = "<span style='background-color: lightgreen; border-radius: 25px;'><b><i>&nbsp;Roll Over(NEW)&nbsp;</b></i></span>";
	}else if($row['tdaStats'] == 5){    
		$sub_array[] = "<span style='background-color: pink; border-radius: 25px;'><b><i>&nbsp;Roll Over(OLD)&nbsp;</b></i></span>";
	}else{
        $sub_array[] = "";
    }
    $sub_array[] = $row['ddateAction'];
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