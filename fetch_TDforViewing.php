
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
$sql = "SELECT * FROM `timedeposit` WHERE dStats NOT IN (1, 5)";

$columns = array(
	0 => 'id',
	1 => 'dBank',
	2 => 'dBranch',
	3 => 'dBalance',
	4 => 'dTerm',
	5 => 'dMaturity',
	6 => 'dUponMaturity',
	7 => 'dRemarks',
	8 => 'dStats'
);

if(isset($_POST['search']['value'])) {
	$search_value = $_POST['search']['value'];
	$sql .= " AND (dBank like '%" . $search_value . "%'";
	$sql .= " OR dBranch like '%" . $search_value . "%')";
	// $sql .= " OR serials like '%" . $search_value . "%'";
	// $sql .= " OR location like '%" . $search_value . "%')";
}else {
	$sql .= " ORDER BY id DESC";
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

$value = $row['dBalance'];
$formatted_value = sprintf('%0.2f', $value); // Format value with 2 decimal places
$sub_array[] = number_format($formatted_value, 0, '.', ','); // Add commas for every thousand and append "%"

$data = array();
while ($row = mysqli_fetch_assoc($query)) {
	$sub_array = array();
	$sub_array[] = $row['dBank'];
	$sub_array[] = $row['dBranch'];
	$formatted_balance = number_format($row['dBalance'], 2, '.', ',');
	$sub_array[] = $formatted_balance;
	$sub_array[] = $row['dInterest'] . "%";
    $sub_array[] = $row['dTerm'] . " Days";
	$sub_array[] = $row['dMaturity'];
	// $formatted_net_interest = $row['dBalance '] * $row['dInterest'] * $row['dTerm'] / 360 * 0.80;
	$formatted_net_interest = number_format($row['dUponMaturity'], 2, '.', ',');
    $sub_array[] = $formatted_net_interest;
	$sub_array[] = $row['dRemarks'];
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