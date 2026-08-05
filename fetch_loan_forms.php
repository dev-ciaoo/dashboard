<?php
include('connection.php');

$output = array();

$sql = "SELECT * FROM loanform";

$columns = array(
    0 => 'id',
    1 => 'fileName',
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE fileName LIKE '%" . $search_value . "%'";
}

if (isset($_POST['order'])) {
    $column_index = $_POST['order'][0]['column'];
    $order_direction = $_POST['order'][0]['dir'];
    $column_name = $columns[$column_index];
    $sql .= " ORDER BY " . $column_name . " " . $order_direction;
}else{
    $sql .= " ORDER BY id ASC";
}

if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT " . $start . ", " . $length;
}

$query = mysqli_query($con, $sql);
$count_query = mysqli_query($con, "SELECT COUNT(*) AS count FROM loanform");
$count_row = mysqli_fetch_assoc($count_query);
$count_rows = $count_row['count'];
$data = array();
while ($row = mysqli_fetch_assoc($query)) {
    $sub_array = array();
    $sub_array[] = $row['id'];
    $sub_array[] = $row['fileName'];
    $sub_array[] = "<button class='btn btn-primary btn-sm btnOpen' 
                    onclick='downloadFile(" . $row['id'] . ", \"" . $row['fileName'] . "\")'>
                    Download</button>";
    
    
    // Example condition for displaying a button based on salary type
    // $sub_array[] = "<button class='btn btn-primary btn-sm btnOpen'  id='" . $row['loan_Id'] . "' name='results' value='" . $row['salaryType'] . "' type='button'>OPEN</button>";
    

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
