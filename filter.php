<?php 
include('connection.php');
include('fileupload.php');

$sql = "SELECT * FROM leavetbl WHERE iRemarks = '" .$_POST['insert'] . "'";

if(isset($_POST['insert'])) {
$query = mysqli_query($con, $sql);
}
if(mysqli_num_rows($query) > 0) {
      while($row = mysqli_fetch_assoc($query)) {
        echo  '<tr><td>' . $row['iName'] . '</td><td>' . $row['employee_Id'] . '</td><td>' . $row['iBranch'] . '</td><td>' . $row['dateFrom'] . '</td><td>' . $row['dateTo'] . '</td><td>' . $row['timeFrom'] . '</td><td>' . $row['timeTo'] . '</td><td>' . $row['iRemarks'] . '</td></tr>';
      }

}






// $checkboxVal1 = $_POST['leaveCheck'];
// // $checkboxVal12 = $_POST['overCheck'];
// // $checkboxVal3 = $_POST['disapprovedCheck'];
// // $checkboxVal4 = $_POST['obCheck'];

// $sql = "SELECT * FROM leavetbl WHERE iRemarks = '$checkboxVal1'";
// $query = mysqli_query($con, $sql);
//       echo  '<tr><td>' . $row['iName'] . '</td><td>' . $row['employee_Id'] . '</td><td>' . $row['iBranch'] . '</td><td>' . $row['dateFrom'] . '</td><td>' . $row['dateTo'] . '</td><td>' . $row['timeFrom'] . '</td><td>' . $row['timeTo'] . '</td><td>' . $row['iRemarks'] . '</td></tr>';

//   if(mysqli_num_rows($query) > 0) {
//     while($row = mysqli_fetch_assoc($query)) {
//     }
//   }
//   else {
//     echo '<tr><td> No Result Found.</tr></td>';
//   }


// $output = array();

// if (isset($_POST['btnFilter'])) {
//   $selectedValue = $_POST['selectLeave'];
// }
// $sql = "SELECT * FROM `leavetbl` WHERE iStatus <> 1 AND iRemarks = '" . $selectedValue . "'";


// // if (isset($_POST['order'])) {
// // 	$column_name = $_POST['order'][0]['column'];
// // 	$order = $_POST['order'][0]['dir'];
// // 	$sql .= " ORDER BY " . $columns[$column_name] . " " . $order . " ";
// // } 
// // else{
// // 	$sql .= " ORDER BY id ASC ";
// // }


// // if ($_POST['length'] != -1) {
// // 	$start = $_POST['start'];
// // 	$length = $_POST['length'];
// // 	$limit_condition_sql = $sql;
// // 	$limit_condition_sql .= " LIMIT  " . $start . ", " . $length . " ";
// // }

// // $query = mysqli_query($con, $limit_condition_sql);
// $count_query = mysqli_query($con, $sql);
// $count_rows = mysqli_num_rows($count_query);
// $data = array();
// // print_r(mysqli_fetch_assoc($query));
// // exit();
// while ($row = mysqli_fetch_assoc($count_query)) {
//   $data[] = $row;
// }

// $output = array(
//   'draw' => intval($_POST['draw']),
//   'recordsTotal' => $count_rows,
//   'recordsFiltered' => $count_rows,
//   'data' => $data,
// );
// echo json_encode($output);


// // if(isset($_POST['filterBtn'])) {
//   //   $selectedValue = $_POST['selectedValue'];
//   // //   $sql .= " WHERE iStatus <> 1 AND iRemarks = '" . $selectedValue . "'";
//   // // $dateFrom = $_POST['dateFROM'];
//   // // $dateTo = $_POST['dateTO'];
//   // $sql = "SELECT iName, employee_Id, iBranch, dateFrom, dateTo, timeFrom, timeTo, iRemarks FROM `leavetbl` WHERE iStatus <> 1 AND iRemarks = '" . $selectedValue . "'";
//   // $query = mysqli_query($con, $sql);
//   // if($query == true) {
//   //     while($data = mysqli_fetch_assoc($query)){
//   //         echo '<tr>';
//   //         echo '<td>' . $row['iName'] . '</td>';
//   //         echo '<td>' . $row['employee_Id'] . '</td>';
//   //         echo '<td>' . $row['iBranch'] . '</td>';
//   //         echo '<td>' . $row['employee_Id'] . '</td>';
//   //         echo '<td>' . $row['dateFrom'] . '</td>';
//   //         echo '<td>' . $row['dateTo'] . '</td>';
//   //         echo '<td>' . $row['timeFrom'] . '</td>';
//   //         echo '<td>' . $row['timeTo'] . '</td>';
//   //         echo '<td>' . $row['iRemarks'] . '</td>';
//   //         echo '</tr>';
//   //     }
//   //     $data = array();
//   // }
//   //     echo json_encode($data);
//   // else {
//   //     // echo "<tr><td colspan='3'> No results found</td></tr>";
//   //     $data = array();
//   //     echo json_encode($data);
//   // }
//   // }
?>