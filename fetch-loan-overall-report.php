
<?php
include('connection.php');
$salaryTypee = [
    'Consumer Loan Balloon', 
    'Consumer Loan Diminishing', 
    'Consumer Loan Diminishing Balloon', 
    'End-Buyer SunTrust Diminishing', 
    'SME-Loan Balloon', 
    'SME-Loan Diminishing',
    'SME-Loan Diminishing Balloon'
];

$salaryTypeeList = "'" . implode("', '", $salaryTypee) . "'";
$output = array();
$sql = "SELECT b.branchName, 
                SUM(l.pipeStats = 3) AS released,
                SUM(d.duecDLate > 0 AND d.duecStatus = 'Past Due') AS pastdue,
                SUM(CASE WHEN ll.prodName IN ($salaryTypeeList) AND ll.borrowerType <> 'Corporate Business' THEN 1 ELSE 0 END) AS indivC,
                SUM(CASE WHEN ll.prodName = 'Salary Loan' THEN 1 ELSE 0 END) AS salC,
                SUM(CASE WHEN ll.prodName = 'Employee Loan' THEN 1 ELSE 0 END) AS empC,
                SUM(CASE WHEN ll.prodName = 'Microfinance Loan' THEN 1 ELSE 0 END) AS microC,
                SUM(CASE WHEN ll.borrowerType = 'Corporate Business' THEN 1 ELSE 0 END) AS corpC,
                SUM(ll.mis = 'Small Scale Enterprises') AS sse,
                SUM(ll.mis = 'Medium Scale Enterprises') AS mse,
                SUM(ll.prodName = 'Hold-Out Deposit Diminishing') AS holdOut,
                SUM(ll.prodName = 'End-Buyer SunTrust Diminishing') AS endBC
            FROM loan AS l
            LEFT JOIN loanledger AS ll ON ll.loanIdd = l.loan_Id
            INNER JOIN branches AS b ON l.branch = b.branchName
            LEFT JOIN duecollection AS d ON l.loan_Id = d.duecLoanId
            ";

if (isset($_POST['search']['value'])) {
    $search_value = mysqli_real_escape_string($con, $_POST['search']['value']);
    $sql .= " WHERE (l.customerFullName LIKE '%$search_value%' OR b.branchName LIKE '%$search_value%')";
}

// Grouping the data by branchName
$sql .= " GROUP BY b.branchName";

// Sorting logic
if (isset($_POST['order'])) {
    $column_index = intval($_POST['order'][0]['column']);
    $order = $_POST['order'][0]['dir'] === 'asc' ? 'ASC' : 'DESC';

    $columns = [
        0 => 'branchName',
        1 => 'released',
        2 => 'pastdue',
        4 => 'indivC',
        5 => 'corpC',
        6 => 'salC',
        7 => 'empC',
        8 => 'microC',
        9 => 'holdOut',
        10 => 'endBC',
        11 => 'sse',
        12 => 'mse'
    ];

    if (isset($columns[$column_index])) {
        $column_name = $columns[$column_index];

        // Casting for numeric fields to ensure proper sorting
        // if (in_array($column_name, ['indivC', 'corpC', 'salC', 'empC', 'microC', 'holdOut', 'endBC', 'sse', 'mse'])) {
        //     $sql .= " ORDER BY $column_name $order";
        // } else {
            $sql .= " ORDER BY $column_name $order";
        // }
    }
} else {
    $sql .= " ORDER BY branchName ASC";
}

// // Debug the SQL query
// error_log($sql);


if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $limit_condition_sql = $sql;
    $limit_condition_sql .= " LIMIT " . intval($start) . ", " . intval($length); // Added intval for security
}

$query = mysqli_query($con, isset($limit_condition_sql) ? $limit_condition_sql : $sql);
$count_query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($count_query);
$data = array();
$totalPastDue = 0;
while ($row = mysqli_fetch_assoc($count_query)){
    $totalPastDue += $row['pastdue'];
}

while ($row = mysqli_fetch_assoc($query)) {
    $sub_array = array();
    $sub_array[] = $row['branchName'];
    $sub_array[] = $row['released'];
    $sub_array[] = $row['pastdue'];
  
    
    $pastDueRatio = $totalPastDue > 0 ? ($row['pastdue'] / $totalPastDue) * 100 : 0;
    $pastDueRatioD = number_format($pastDueRatio, 2);
    $sub_array[] = $pastDueRatioD . '%';
    // $sub_array[] = $totalPastDue . '/' . $pastDueRatio; 

    $sub_array[] = $row['indivC'];
    $sub_array[] = $row['corpC'];
    $sub_array[] = $row['salC'];
    $sub_array[] = $row['empC'];
    $sub_array[] = $row['microC'];
    $sub_array[] = $row['holdOut'];
    $sub_array[] = $row['endBC'];   
    $sub_array[] = $row['sse'];
    $sub_array[] = $row['mse'];
    // $sub_array[] = $row['indivC'] + $row['corpC'] + $row['salC'] + $row['microC'] + $row['holdOut'] + $row['empC'];

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
