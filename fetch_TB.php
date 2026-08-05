
<?php
include('connection.php');

// $imgExt = array(
//     'gif',
//     'jpg',
//     'jpeg',
//     'png'
// );

function format_number($number) {
    // Use number_format to format the number with commas for every thousand
    $formatted_number = number_format($number);


}

$output = array();
$sql = "SELECT * FROM `treasurybill` WHERE tStats NOT IN (1, 5)";

$columns = array(
	0 => 'id',
	1 => 'tBank',
	2 => 'tBranch',
	3 => 'tParValue',
	4 => 'tTerms',
	5 => 'tInterest',
	6 => 'tMaturity',
	7 => 'tNetInterest',
	8 => 'bonds',
	9 => 'bondsBank',
	10 => 'tStats'
);

if(isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " AND (tBank like '%" . $search_value . "%'";
	$sql .= " OR tBranch like '%" . $search_value . "%')";
	// $sql .= " OR serials like '%" . $search_value . "%'";
	// $sql .= " OR location like '%" . $search_value . "%')";
}

if(isset($_POST['order'])) {
    $order_column_index = $_POST['order'][0]['column'];
    if (array_key_exists($order_column_index, $columns)) {
        $order_column_name = $columns[$order_column_index];
        $order_dir = $_POST['order'][0]['dir'];
        
        // Modify the SQL query to order by the selected column and direction
        $sql .= " ORDER BY $order_column_name $order_dir";
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

$value = $row['tParValue'];
$formatted_value = sprintf('%0.2f', $value); // Format value with 2 decimal places
$sub_array[] = number_format($formatted_value, 0, '.', ','); // Add commas for every thousand and append "%"

$data = array();
while ($row = mysqli_fetch_assoc($query)) {
	$sub_array = array();
	$sub_array[] = $row['tBank'];
	$sub_array[] = $row['tBranch'];
	$sub_array[] = number_format($row['tParValue']) . ".00";
	$sub_array[] = $row['tTerms'];
    $sub_array[] = $row['tInterest'] . "%";
	$sub_array[] = $row['tMaturity'];
	$formatted_net_interest = number_format($row['tNetInterest'], 2, '.', ',');
    $sub_array[] = $formatted_net_interest;
	$sub_array[] = $row['bondsBank'];
	// $sub_array[] = $row['dateAction'];
	if($row['tStats'] != 5 || $row['tStats'] != 1){
		$sub_array[] = '<a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-danger btn-sm btnCheck">Close</a>';
						// <a href="javascript:void(0);" data-id="' . $row['id'] . '"  class="btn btn-danger btn-sm btnX">Roll Over</a>';
	}else {
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