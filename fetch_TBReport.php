
<?php
include('connection.php');

function format_number($number) {
    // Use number_format to format the number with commas for every thousand
    $formatted_number = number_format($number);
}

$output = array();
$sql = "SELECT * FROM `tbillarchived`";

$columns = array(
	0 => 'id',
    1 => 'tb_id',
	2 => 'tbaBank',
	3 => 'tbaBranch',
	4 => 'tbaParValue',
	5 => 'tbaTerms',
	6 => 'tbaInterest',
	7 => 'tbaMaturity',
	8 => 'tbaNetInterest',
	9 => 'tbaStats',
    10 => 'dateAction'
);

if(isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE (tbaBank like '%" . $search_value . "%'";
	$sql .= " OR tbaBranch like '%" . $search_value . "%')";
}

if(isset($_POST['order'])) {
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
} else{
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
	$sub_array[] = $row['tbaBank'];
	$sub_array[] = $row['tbaBranch'];
	$sub_array[] = number_format($row['tbaParValue'], 2, '.', ',');
	$sub_array[] = $row['tbaTerms'] . " Days";
    $sub_array[] = $row['tbaInterest'] . "%";
	$sub_array[] = $row['tbaMaturity'];
	$formatted_net_interest = number_format($row['tbaNetInterest'], 2, '.', ',');
    $sub_array[] = $formatted_net_interest;
	if($row['tbaStats'] == 0){
		$sub_array[] = "<span style='background-color: pink; border-radius: 25px;'><b><i>&nbsp;Close(OLD)&nbsp;</b></i></span>";
	}else if($row['tbaStats'] == 1){
		$sub_array[] = "<span style='background-color: lightgreen; border-radius: 25px;'><b><i>&nbsp;Closed(NEW)&nbsp;</b></i></span>";
	}else{
        $sub_array[] = "";
    }
    $sub_array[] = $row['dateAction'];
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